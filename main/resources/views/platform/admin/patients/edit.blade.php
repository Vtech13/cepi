<x-layouts.app :class-body="$class_body" link-active="patients">

    <style>
        .textarea{
            margin-bottom: 20px;
            height: auto;
        }
    </style>

    <x-section>
        <h1>Patient {{ $patient->firstname }} {{ $patient->lastname }}</h1>

        <form action="{{ route('admin.patients.update', $patient->id) }}" method="post" enctype="multipart/form-data" class="form">
            @csrf
            @method('put')

            <input type="hidden" name="confrere" value="{{ $patient->user->id }}">
            <input type="hidden" name="confrere_email" value="{{ $patient->user->email }}">

            <div class="block-content mb-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <p>
                            Confrere :
                            <a href="{{ route('admin.confreres.edit', $patient->user->id) }}">
                                {{ $patient->user->firstname }} {{ $patient->user->lastname }}
                            </a>
                        </p>
                        <p>
                            Prénom : {{ $patient->firstname }} <br>
                            Nom : {{ $patient->lastname }} <br>
                            Date de naissance : {{ $patient->date_of_birth }} <br>
                            Téléphone : {{ $patient->phone }} <br>
                            Motif : {{ \App\Models\Patient::MOTIFS[$patient->motif] }} <br>
                            E-mail : {{ $patient->email }}
                        </p>

                        <div>
                            <x-form.select name="status" label="Statut" :options="\App\Enums\PatientStatus::STATUSES"
                                           :bind="$patient->status ?? null"/>
                            <x-form.input type="text" name="lastname" label="Nom de famille" :bind="$patient->lastname ?? null"/>
                            <x-form.input type="text" name="firstname" label="Prénom" :bind="$patient->firstname ?? null"/>
                            <x-form.input type="text" name="phone" label="Téléphone" :bind="$patient->phone ?? null"/>
                            <x-form.input name="date_of_birth" label="Date de naissance *"
                                            placeholder="Entrez la date de naissance (24/01/1990)"
                                            bind="{{ $patient->date_of_birth ?? null }}" required></x-form.input>                            <x-form.select name="motif" label="Motif" :options="\App\Models\Patient::MOTIFS"
                                           :bind="$patient->motif ?? null"/>
                            <x-form.input name="email" label="Adresse mail"
                                        bind="{{ $patient->email ?? null }}"></x-form.input>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <h2>Suivi du patient</h2>
                        <div>
                            @foreach($patient->logs as $log)
                                @foreach($log->value as $status)
                                    <p>
                                        {{ \App\Enums\PatientStatus::STATUSES[$status] }} -
                                        le {{ $log->created_at->format('d/m/Y à H:i') }}
                                    </p>
                                @endforeach
                            @endforeach
                        </div>
                        <div class="block-content"> 
                            <div class="form__group">
                                <input type="file"
                                    name="files[]"
                                    id="files"
                                    class="form__input"
                                    placeholder="Entrez les images/documents (JPG/PNG/PDF)"
                                    multiple
                                    label="Déposez des fichiers ici ou cliquez pour télécharger."
                                    help="Téléchargez des images/documents (JPG/PNG/PDF) ici et ils ne seront pas envoyés immédiatement."
                                    is="drop-files">
                                @if ($errors->has('files'))
                                    <div class="form__field-error">{{ $errors->first('other_files') }}</div>
                                @endif
                            </div>

                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        </div>
                        <div class="block-content">
                            @php
                                // Récupérer le nom de l'utilisateur connecté
                                $myName = auth()->user()->firstname . ' ' . auth()->user()->lastname;

                                // Diviser le contenu en sections
                                $sections = explode("----------------", $patient->information);
                            @endphp

                            <h2>Informations</h2>


                            @foreach ($sections as $index => $section)
                                @if ($section !== '') <!-- Ignorer la section vide -->
                                    <div>
                                        <textarea class="form__input textarea"
                                            id="information[{{ $index }}]" 
                                            name="information[{{ $index }}]" 
                                            rows="4" 
                                        >{{ $section }}</textarea>
                                    </div>
                                @endif
                            @endforeach

                            <!-- Ajoutez ce code où vous voulez ajouter le champ de saisie -->
                            <div>
                                <h2>Ajouter des informations</h2>
                                <textarea class="form__input textarea" type="text" name="new_information" label="Nouvelle information"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-form.button>Enregistrer</x-form.button>

        </form>

        @if (!empty($patient))
                <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="post" class="form"
                    id="delete-patient">
                    @csrf
                    @method('delete')
                    <x-form.button class="btn--link js__delete-patient" data-id="delete-patient">
                        Supprimer ce patient
                    </x-form.button>
                </form>
            @endif
            
        @if (!empty($patient->attachments))
        <x-section>
            <h2>Compte-rendu</h2>
            <div class="block-content">
                <table class="table table-responsive table__compte-rendu" id="table">
                    <thead>
                    <tr>
                        <th>Document</th>
                        <th>Date ajout document</th>
                        <th class="table-action">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($patient->user->attachments as $attachment)
                        @if ($attachment->patient_id === $patient->id)                
                                <tr>
                                    <td>{{ $attachment->name }}</td>
                                    <td>{{ $attachment->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td class="actions t-center">
                                        @if ($attachment->type === \App\Models\Attachment::TYPE_IMG)
                                            <div class="js__lightbox-btn" data-type="img"
                                                data-url="{{ route('admin.files.show', $attachment->id) }}">
                                                <span class="icon icon-view"></span>
                                            </div>
                                        @else
                                            <a href="{{ route('admin.files.show', $attachment->id) }}" target="_blank"
                                            title="Voir le fichier">
                                                <span class="icon icon-download-pdf"></span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        @foreach ($patient->attachments as $attachment)
                                <tr>
                                    <td>{{ $attachment->name }}</td>
                                    <td>{{ $attachment->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td class="actions t-center">
                                        @if ($attachment->type === \App\Models\Attachment::TYPE_IMG)
                                            <div class="js__lightbox-btn" data-type="img"
                                                data-url="{{ route('admin.files.show', $attachment->id) }}">
                                                <span class="icon icon-view"></span>
                                            </div>
                                        @else
                                            <a href="{{ route('admin.files.show', $attachment->id) }}" target="_blank"
                                            title="Voir le fichier">
                                                <span class="icon icon-download-pdf"></span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-section>
    @endif
    </x-section>

</x-layouts.app>
