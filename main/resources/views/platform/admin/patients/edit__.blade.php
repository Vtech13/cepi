<x-layouts.app :class-body="$class_body" :link-active="$link_active">
    <x-section fluid>
        <h1>{{ !empty($patient) ? 'Modifier' : 'Ajouter' }} un patient</h1>

        <div class="block-content mb-30">
            <form
                action="{{ !empty($patient) ? route('admin.patients.update', $patient->id) : route('admin.patients.store') }}"
                method="post" class="form">
                @csrf
                @if (!empty($patient)) @method('put') @endif

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <x-form.input name="firstname" label="Prénom *"
                                      bind="{{ $patient->firstname ?? null }}"
                                      required></x-form.input>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <x-form.input name="lastname" label="Nom *"
                                      bind="{{ $patient->firstname ?? null }}"
                                      required></x-form.input>
                    </div>
                </div>

                <x-form.textarea name="information" label="Information"
                                 bind="{{ $patient->information ?? null }}"></x-form.textarea>

                <x-form.button>Enregistrer</x-form.button>
            </form>
        </div>

        <div class="block-content mb-30">
            <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data"
                  class="form">
                @csrf

                <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <x-form.input name="name" label="Catégorie"/>
                        <x-form.textarea name="information" label="Information"/>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form__group">
                            <label for="files" class="form__label">Images/Documents</label>
                            <input type="file"
                                   name="files[]"
                                   id="files"
                                   class="form__input"
                                   placeholder="Entrez les images/documents (JPG/PNG/PDF)"
                                   multiple
                                   label="Déposez des fichiers ici ou cliquez pour télécharger."
                                   help="Téléchargez des images/documents (JPG/PNG/PDF) ici et ils ne seront pas envoyés immédiatement."
                                   is="drop-files">
                            @if ($errors->has('other_files'))
                                <div class="form__field-error">{{ $errors->first('other_files') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <x-form.button>Envoyer</x-form.button>
            </form>
        </div>

        @foreach ($patient->categories as $category)
            <div class="block-content mb-30">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="post"
                      enctype="multipart/form-data" class="form">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <x-form.input name="name" id="name-{{ $category->id }}" :bind="$category->name"/>
                            <x-form.textarea name="information" id="information-{{ $category->id }}" :bind="$category->information" />
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="form__group">
                                <input type="file"
                                       name="files[]"
                                       id="files-{{ $category->id }}"
                                       class="form__input"
                                       placeholder="Entrez les images/documents (JPG/PNG/PDF)"
                                       multiple
                                       label="Déposez des fichiers ici ou cliquez pour télécharger."
                                       help="Téléchargez des images/documents (JPG/PNG/PDF) ici et ils ne seront pas envoyés immédiatement."
                                       is="drop-files">
                                @if ($errors->has('other_files'))
                                    <div class="form__field-error">{{ $errors->first('other_files') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="attachment-preview">
                        @foreach ($category->attachments as $attachment)
                            <x-attachment-preview :attachment="$attachment" :delete="true"/>
                        @endforeach
                    </div>

                    <x-form.button>Modifier</x-form.button>
                </form>
            </div>
        @endforeach

    </x-section>
</x-layouts.app>
