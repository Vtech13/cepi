<x-layouts.app :class-body="$class_body" link-active="patients">
    <x-section>
        <h1>Ajouter un patient</h1>

        <div class="block-content">
                <form
                    action="{{ route('admin.patients.store') }}" method="post" enctype="multipart/form-data" class="form">
                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <x-form.input name="firstname" label="Prénom *"
                                        bind="{{ $patient->firstname ?? null }}" required></x-form.input>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <x-form.input name="lastname" label="Nom *"
                                        bind="{{ $patient->lastname ?? null }}" required></x-form.input>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <x-form.input name="phone" label="Telephone *"
                                        bind="{{ $patient->phone ?? null }}" required></x-form.input>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <x-form.input name="date_of_birth" label="Date de naissance *"
                                        placeholder="Entrez la date de naissance (24/01/1990)"
                                        bind="{{ $patient->date_of_birth ?? null }}" required></x-form.input>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <x-form.input name="email" label="Adresse mail"
                                        bind="{{ $patient->email ?? null }}"></x-form.input>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div>
                                <h2>Ajouter des informations</h2>
                                <x-form.input type="text" name="information" label="Nouvelle information" />
                            </div>
                        </div>
                    </div>



                    <x-form.select name="motif" label="Motif *" bind="{{ $patient->motif ?? null }}"
                                :options="$motifs" required/>
                    
                    <x-form.select name="confrere" label="Confrère *" bind="{{ $patient->confrere ?? null }}" required>
                        @isset($confreres)
                            @foreach($confreres as $confrere)
                            <option value="{{ $confrere->id }}">{{ $confrere->firstname }} {{ $confrere->lastname }}</option>
                            @endforeach
                        @else
                            <option value="">Aucun confrère disponible</option>
                        @endisset
                    </x-form.select>

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

                    <x-form.button>Enregistrer</x-form.button>
                </form>
            </div>
    </x-section>
</x-layouts.app>
