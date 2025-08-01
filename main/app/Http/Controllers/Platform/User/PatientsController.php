<?php

namespace App\Http\Controllers\Platform\User;

use App\Http\Controllers\Controller;
use App\Enums\PatientStatus;
use App\Models\Patient;
use App\Models\User;
use App\Models\PatientLog;
use App\Http\Requests\PatientRequest;
use Illuminate\Http\Request;
use App\Repositories\AttachmentsRepository;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class PatientsController extends Controller
{
    private $class_body = 'patients no-sidebar';
    private $attachmentsRepository;
    private $user;

    public function __construct(AttachmentsRepository $attachmentsRepository, User $user)
    {
        $this->attachmentsRepository = $attachmentsRepository;
        $this->user = $user;
    }

    public function index(Request $request)
    {
        return view('platform.user.patients.index', [
            'class_body' => $this->class_body,
            'patients'   => Patient::query()
                ->where('created_user_id', $request->user()->id)
                ->orderBy('lastname')
                ->get()
        ]);
    }

    public function edit(Patient $patient, Request $request)
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

        return view('platform.user.patients.edit', [
            'class_body' => $this->class_body,
            'patient'    => $patient,
        ]);
    }

    public function create()
    {
        return view('platform.user.patients.create', [
            'class_body' => $this->class_body,
            'motifs'     => collect(Patient::MOTIFS)->prepend('Selectionner un motif', '')->toArray()
        ]);
    }

    public function store(PatientRequest $request)
    {
        $information = $request->input('information');
        $myName = $request->user()->firstname . ' ' . $request->user()->lastname;
        $informationContent = $myName . ', le ' . date('d/m/Y') . ' à ' . date('H:i') . " : \n" . $information;

        $patient = Patient::query()->create(array_merge(
            $request->validated(),
            [
                'created_user_id' => $request->user()->id,  
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
                        auth()->id(),
                    );
                }
            }
        }

        return redirect()->route('user.patients.index')->with('success', 'Le patient a bien été adressé.');
    }

    public function update(Patient $patient, PatientRequest $request)
    {
        $this->authorize('update', $patient);

        $validated = $request->validate([
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
                        auth()->id(),
                    );
                }
            }
        }
    
        return redirect()->route('user.patients.index')->with('success', 'Le patient a bien été modifié.');
    }


    public function destroy(Patient $patient, Request $request)
    {
        $this->authorize('update', $patient);

        $patient->load('attachments');
        $patient->load('user.attachments');
        $patient->load('logs');

        foreach ($patient->attachments as $attachment) {
            $attachment->delete();
        }

        foreach ($patient->logs as $log) {
            $log->delete();
        }

        foreach ($patient->user->attachments as $attachment) {
            if ($attachment->patient_id === $patient->id) {
                $attachment->delete();
            }
        }

        Storage::deleteDirectory("patients/patient-$patient->id");

        $patient->delete();

        return redirect()->route('user.patients.index')->with('success', 'Le patient a bien été supprimé.');
    }
}