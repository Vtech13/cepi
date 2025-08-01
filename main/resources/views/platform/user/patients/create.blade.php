<x-layouts.app :class-body="$class_body" link-active="patients">
    <x-section>
        <form
            action="{{ route('user.patients.store') }}" method="post" enctype="multipart/form-data" class="form">
            @csrf

            <h1>Ajouter un patient</h1>
            <div class="block-content mb-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div>
                            <x-form.input type="text" name="lastname" label="Nom de famille" :bind="$patient->lastname ?? null"/>
                            <x-form.input type="text" name="firstname" label="Prénom" :bind="$patient->firstname ?? null"/>
                            <x-form.input type="text" name="phone" label="Téléphone" :bind="$patient->phone ?? null"/>
                            <x-form.input name="date_of_birth" label="Date de naissance *"
                                            placeholder="Entrez la date de naissance (24/01/1990)"
                                            bind="{{ $patient->date_of_birth ?? null }}" required></x-form.input>                            
                            <x-form.select name="motif" label="Motif" :options="\App\Models\Patient::MOTIFS"
                                           :bind="$patient->motif ?? null"/>
                            <x-form.input name="email" label="Adresse mail "
                                        bind="{{ $patient->email ?? null }}"></x-form.input>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
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
                        </div>
                        <div class="block-content">
                            <!-- Ajoutez ce code où vous voulez ajouter le champ de saisie -->
                            <div>
                                <h2>Ajouter des informations</h2>
                                <x-form.input type="text" name="information" label="Nouvelle information" />
                            </div>
                        </div>                    </div>
                </div>
            </div>
            <x-form.button>Enregistrer</x-form.button>
        </form>
    </x-section>
</x-layouts.app>
