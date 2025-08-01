<?php

namespace App\Http\Controllers\Platform\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UpdateInfoPatient;
use App\Enums\PatientStatus;
use App\Models\Patient;
use App\Models\User;
use App\Models\PatientLog;
use App\Http\Requests\PatientRequest;
use Illuminate\Http\Request;
use App\Repositories\AttachmentsRepository; // Add this line
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class PatientsController extends Controller
{
    private $class_body = 'patients no-sidebar';
    private $attachmentsRepository;
    private $user; // Add this line

    public function __construct(AttachmentsRepository $attachmentsRepository, User $user) // Add $user parameter
    {
        $this->attachmentsRepository = $attachmentsRepository;
        $this->user = $user; // Assign $user to the property
    }

    public function index()
    {
        // Afficher tous les patients
        return view('platform.admin.patients.index', [
            'class_body' => $this->class_body,
            'patients'   => Patient::query()->orderBy('lastname')->get()
        ]);
    }

    public function edit(Patient $patient)
    {
        $this->authorize('update', $patient);

        $patient->load([
            'attachments' => function ($query) {
                $query->orderByDesc('created_at');
            },
            'user.attachments' => function ($query) {
                $query->orderByDesc('created_at');
            }
        ]);

        // Afficher un patient et permettre la modification du statut et des informations
        return view('platform.admin.patients.edit', [
            'class_body' => $this->class_body,
            'patient'    => $patient,
        ]);
    }

    public function create()
    {
        $confreres = $this->user->newQuery()
        ->confrere()
        ->select(['id', 'firstname', 'lastname', 'created_at', 'login_at', 'login_link_sent_at'])
        ->orderBy('lastname')
        ->get();

        return view('platform.admin.patients.add', [
            'class_body' => $this->class_body,
            'motifs'     => collect(Patient::MOTIFS)->prepend('Selectionner un motif', '')->toArray(),
            'confreres'   => $confreres
        ]);
    }

    public function store(PatientRequest $request)
    {
        $confrereId = $request->input('confrere'); // Récupérer l'ID du confrère sélectionné
        
        $information = $request->input('information');
        $myName = $request->user()->firstname . ' ' . $request->user()->lastname;
        $informationContent = $myName . ', le ' . date('d/m/Y') . ' à ' . date('H:i') . " : \n" . $information;

        $patient = Patient::query()->create(array_merge(
            $request->validated(),
            [
                'created_user_id' => $confrereId,
                'status'          => PatientStatus::DEMANDE_RECUE,
                'information'     => $informationContent,
            ]
        ));

        PatientLog::query()->create([
            'patient_id' => $patient->id,
            'user_id'    => $request->user()->id,
            'value'      => ['status' => PatientStatus::DEMANDE_RECUE]
        ]);
  
        if ($request->has('files')) {
            $files = $request->file('files');
            if ($files !== null) {
                foreach ($files as $file) {
                    $this->attachmentsRepository->storeFile(
                        $file,
                        Patient::class,
                        $patient->id,
                        $confrereId,
                    );
                }
            }
        }


        return redirect()->route('admin.patients.index')->with('success', 'Le patient a bien été adressé.');
    }

    public function update(Patient $patient, Request $request)
    {
        $confrereId = $request->input('confrere'); // Récupérer l'ID du confrère sélectionné
        $confrereEmail = $patient->user->email;

        $this->authorize('update', $patient);

        $validated = $request->validate([
            'status'      => 'required',
            'lastname' => 'required',
            'firstname' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'motif' => 'required',
            'email' => 'nullable',
        ]);

        // Extraction des sections existantes, en conservant le format avec les séparateurs
        $existingInformation = $patient->information;
        $sections = $existingInformation ? explode("----------------", $existingInformation) : [];

        // Mise à jour des sections existantes avec les données reçues
        $updatedSections = $request->input('information', []);
        foreach ($updatedSections as $index => $updatedSection) {
            // Assurez-vous que l'index existe dans les sections existantes avant de mettre à jour
            if (isset($sections[$index])) {
                $sections[$index] = $updatedSection; // Mettez à jour la section existante
            }
        }

        // Traitement de la nouvelle information
        $newInfo = $request->input('new_information');
        if (!empty($newInfo)) {
            $userName = auth()->user()->firstname . ' ' . auth()->user()->lastname;
            $dateTime = now()->format('d/m/Y à H:i');
            // Construire la nouvelle section d'information avec le séparateur
            $newInfoSection = $userName . ", le " . $dateTime . " : " . $newInfo;
            // Ajouter la nouvelle section formatée aux sections existantes
            $sections[] = $newInfoSection;
        }

        // Reconstruire la chaîne d'information avec les séparateurs appropriés
        $informationContent = implode("----------------", array_filter($sections, function($value) {
            return !is_null($value) && $value !== '';
        }));

        // Ajouter un séparateur au début si nécessaire
        if (!empty($informationContent)) {
            $informationContent = "----------------" . $informationContent;
        }

        // Mettre à jour le patient avec les informations validées et concaténées
        $patient->update(array_merge($validated, ['information' => $informationContent]));


        if ($patient->wasChanged('status')) {
            PatientLog::query()->create([
                'patient_id' => $patient->id,
                'user_id'    => $request->user()->id,
                'value'      => ['status' => $patient->status]
            ]);
        }

        if ($request->has('files')) {
            $files = $request->file('files');
            if ($files !== null) {
                foreach ($files as $file) {
                    $this->attachmentsRepository->storeFile(
                        $file,
                        Patient::class,
                        $patient->id,
                        $confrereId,
                    );
                }
            }
        }

        $patient->save();

        Mail::to($confrereEmail)->send(new UpdateInfoPatient($patient->lastname, $patient->firstname, $request->user()->lastname, $request->user()->firstname ));

        return redirect()->route('admin.patients.index')->with('success', 'Le patient a bien été modifié.');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Patient $patient, Request $request)
    {
        $this->authorize('update', $patient);
    
        // Load the attachments and logs relations
        $patient->load('attachments');
        $patient->load('user.attachments');
        $patient->load('logs');
    
        // Delete each attachment
        foreach ($patient->attachments as $attachment) {
            $attachment->delete();
        }

                // Delete each log
        foreach ($patient->logs as $log) {
            $log->delete();
        }
    
        foreach ($patient->user->attachments as $attachment) {
            if ($attachment->patient_id === $patient->id) {
                $attachment->delete();
            }
        }
    
        Storage::deleteDirectory("patients/patient-$patient->id");
    
        // Now it's safe to delete the patient
        $patient->delete();
    
        return back()->with('success', 'Le patient a bien été supprimé.');
    }
}
