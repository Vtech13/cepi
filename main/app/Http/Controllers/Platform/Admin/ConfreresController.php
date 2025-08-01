<?php

namespace App\Http\Controllers\Platform\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfrereRequest;
use App\Mail\RegisterConfrere;
use App\Mail\UploadDocument;
use App\Models\Patient;
use App\Models\User;
use App\Models\UserRole;
use App\Repositories\AttachmentsRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function back;
use function redirect;
use function view;

class ConfreresController extends Controller
{
    /**
     * @var string
     */
    private $class_body;

    /**
     * @var string
     */
    private $link_active;

    /**
     * @var User
     */
    private $user;

    /**
     * @var AttachmentsRepository
     */
    private $attachmentsRepository;

    public function __construct(User $user, AttachmentsRepository $attachmentsRepository)
    {
        $this->class_body = 'page-confreres no-sidebar';
        $this->link_active = 'confreres';
        $this->user = $user;
        $this->attachmentsRepository = $attachmentsRepository;
    }

    /**
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $confreres = $this->user->newQuery()
            ->confrere()
            ->select(['id', 'firstname', 'lastname', 'created_at', 'login_at', 'login_link_sent_at'])
            ->orderBy('lastname')
            ->get();

        return view('platform.admin.confreres.index', [
            'class_body'  => $this->class_body,
            'link_active' => $this->link_active,
            'confreres'   => $confreres
        ]);
    }

    /**
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $confrere = new User; // Ajoutez cette ligne
        return view('platform.admin.confreres.edit', [
            'class_body'  => $this->class_body,
            'link_active' => $this->link_active,
            'confrere'    => $confrere // Ajoutez cette ligne
        ]);
    }

    /**
     * @param ConfrereRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function store(ConfrereRequest $request): RedirectResponse
    {
        $confrereId = $request->input('confrere'); // Récupérer l'ID du confrère sélectionné

        $this->authorize('create', User::class);

        $confrere = $this->user->newQuery()->create(array_merge(
            [
                'created_user_id'  => $request->user()->id,
                'ref_user_role_id' => UserRole::CONFRERE,
                'token'            => Str::random(64)
            ],
            $request->validated()
        ));

        $patientId = $request->input('patient_id');

        if ($request->has('files')) {
            if($patientId == null) {
            foreach ($request->file('files') as $file) {
                $this->attachmentsRepository->storeFile(
                    $file,
                    User::class,
                    $confrereId,
                    $confrereId,
                );
            }
        } else {
            foreach ($request->file('files') as $file) {
                $this->attachmentsRepository->storeFile(
                    $file,
                    Patient::class,
                    $patientId,
                    $confrereId,
                );
            }
        }
    }

        Mail::to($confrere->email)->send(new RegisterConfrere($confrere->token));

        return redirect()->route('admin.confreres')
            ->with('success', 'Le confrère a bien été créé. Un email a été envoyé au confrère avec les instructions pour finaliser la création de son compte.');
    }

    public function reSentLoginLink(User $confrere)
    {
        if (!empty($confrere->login_at)) {
            return back()->with('error', "Le confrère a déjà créé son compte.");
        }

        $confrere->update([
            'token'              => Str::random(64),
            'login_link_sent_at' => now()
        ]);

        Mail::to($confrere->email)->send(new RegisterConfrere($confrere->token));

        return back()->with('success', "Le lien a été renvoyé au confrere.");
    }

    /**
     * @param User $confrere
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(User $confrere)
    {
        $this->authorize('update', $confrere);

        $confrere->load([
            'attachments' => function (MorphMany $q) {
                return $q->orderByDesc('created_at');
            }
        ]);

        $patients = Patient::query()
        ->where('created_user_id', $confrere->id)
        ->orderBy('lastname')
        ->get();
    
        $patients->each(function ($model) {
            $model->setAppends(['full_name']);
        });

        return view('platform.admin.confreres.edit', [
            'class_body'  => $this->class_body,
            'link_active' => $this->link_active,
            'confrere'    => $confrere,
            'patients'    => $patients->pluck('full_name', 'id')
                ->prepend('Selectionner un patient', '')->toArray()
        ]);
    }

    /**
     * @param ConfrereRequest $request
     * @param User            $confrere
     * @return RedirectResponse
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function update(ConfrereRequest $request, User $confrere): RedirectResponse
    {
        $confrereId = $request->input('confrere'); // Récupérer l'ID du confrère sélectionné

        $this->authorize('update', $confrere);

        $confrere->update(array_merge(
            ['updated_user_id' => $request->user()->id],
            $request->validated()
        ));

        $message = "Le confrère a bien été mis à jour.";

        $patientId = $request->input('patient_id');

        if ($request->has('files')) {
            if($patientId == null) {
            foreach ($request->file('files') as $file) {
                $this->attachmentsRepository->storeFile(
                    $file,
                    User::class,
                    $confrereId,
                    $confrereId,
                );
            }
        } else {
            foreach ($request->file('files') as $file) {
                $this->attachmentsRepository->storeFile(
                    $file,
                    Patient::class,
                    $patientId,
                    $confrereId,
                );
            }
        }

            $confrere->load('attachments');

            Mail::to($confrere->email)->send(new UploadDocument());

            $message = "Le confrère a bien été mis à jour. Il a été notifié par email de l'ajout de nouveaux documents dans son espace.";
        }

        return back()->with('success', $message);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(User $confrere)
    {
        $this->authorize('update', $confrere);
    
        // Charger les patients du confrere
        $confrere->load('patients');

        // Supprimer chaque patient
        foreach ($confrere->patients as $patient) {
            // Supprimer tous les logs associés au patient
            foreach ($patient->logs as $log) {
                $log->delete();
            }
            foreach ($patient->attachments as $attachment) {
                $attachment->delete();
                Storage::deleteDirectory("patients/patient-$patient->id");
            }

            $patient->delete();
        }
        
        $confrere->load('attachments');
    
        if ($confrere->attachments->isNotEmpty()) {
            foreach ($confrere->attachments as $attachment) {
                $attachment->delete();
            }
    
            Storage::deleteDirectory("confreres/confrere-$confrere->id");
        }
    
        $confrere->delete();
    
        return redirect()->route('admin.confreres')->with('success', 'Le confrère a bien été supprimé.');
    }
}
