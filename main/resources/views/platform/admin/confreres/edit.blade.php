<style>
    .js__delete-patient{
        min-width: 25px!important;
        margin: 0!important;
        padding: 0!important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
            var table = $('#table');
        var rows = table.find('tr:gt(0)').toArray().sort(comparer(1)); // Index 1 pour la colonne "Nom"
        table.append(rows);
    });

    function comparer(index) {
        return function(a, b) {
            var valA = getCellValue(a, index), valB = getCellValue(b, index);
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
        }
    }

    function getCellValue(row, index){
        return $(row).children('td').eq(index).text();
    }
</script>

<x-layouts.app :class-body="$class_body" :link-active="$link_active">
    <x-section>
        <h1>{{ !empty($confrere->id) ? 'Modifier' : 'Ajouter' }} un confrère</h1>

        <form
            action="{{ !empty($confrere->id) ? route('admin.confreres.update', $confrere->id) : route('admin.confreres.store') }}"
            method="post" enctype="multipart/form-data" class="form">
            @csrf
            @if (!empty($confrere->id))
                @method('put')
            @endif

            <input type="hidden" name="confrere_id" value="{{ $confrere->id }}">

            <div class="row">
                @if (!empty($confrere->id))
                <div class="col-xs-12 col-sm-6">
                @else
                <div class="col-xs-12 col-sm-12">
                @endif
                    <div class="block-content mb-30">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <x-form.input name="firstname" label="Prénom *"
                                              bind="{{ $confrere->firstname ?? null }}"
                                              required></x-form.input>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <x-form.input name="lastname" label="Nom *"
                                              bind="{{ $confrere->lastname ?? null }}" required></x-form.input>
                            </div>
                        </div>

                        <x-form.input type="email" name="email" label="Email *"
                                      bind="{{ $confrere->email ?? null }}"></x-form.input>

                        <x-form.textarea name="information" label="Informations"
                                         bind="{{ $confrere->information ?? null }}"></x-form.textarea>
                    </div>
                </div>
                @if (!empty($confrere->id))
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

                            @if (!empty($patients) && count($patients) > 1)
                                <x-form.select name="patient_id" label="Relier ses fichier à un patient"
                                            :options="$patients"/>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <x-form.button>Enregistrer</x-form.button>
        </form>

        @if (!empty($confrere->id))
            <form action="{{ route('admin.confreres.destroy', $confrere->id) }}" method="post" class="form"
                  id="delete-confrere">
                @csrf
                @method('delete')
                <x-form.button class="btn--link js__delete-confrere" data-id="delete-confrere">
                    Supprimer ce confrère
                </x-form.button>
            </form>
        @endif
    </x-section>

    
    @if (!empty($confrere->id))
        <x-section>
            <h2>Patients</h2>
            <div class="block-content">
                <table class="table table-responsive" id="table">
                    <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <th class="table-action">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($confrere->patients as $patient)
                        <tr>
                            <td style="text-transform: capitalize;">{{ $patient->firstname }}</td>
                            <td style="text-transform: uppercase;">{{ $patient->lastname }}</td>
                            <td>{{ \App\Models\Patient::MOTIFS[$patient->motif] }}</td>
                            <td>{{ \App\Enums\PatientStatus::STATUSES[$patient->status] }}</td>
                            <td class="actions t-center" style="display:flex;">
                                <a href="{{ route('admin.patients.edit', $patient->id) }}" title="Modifier">
                                    <span class="icon icon-edit"></span>
                                </a>
                                @if (!empty($patient))
                                <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="post" class="form"
                                    id="delete-patient-{{ $patient->id }}">
                                    @csrf
                                    @method('delete')
                                    <x-form.button class="btn--link js__delete-patient" data-id="delete-patient-{{ $patient->id }}">
                                        <span class="icon icon-close"></span>
                                    </x-form.button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-section>
    @endif
    @if (!empty($confrere->id))
        <x-section>
            <h2>Documents</h2>
            <div class="block-content">
                <div class="search-block search-block--filter">
                    <div class="form">
                        <x-form.input name="search" id="search-filter" placeholder="Filtrer"></x-form.input>
                    </div>
                </div>

                <table class="table table-responsive" id="table">
                    <thead>
                    <tr>
                        <th>Document</th>
                        <th>Date ajout document</th>
                        <th class="table-action">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $attachments = $confrere->attachments;

                        foreach ($confrere->patients as $patient) {
                            $attachments = $attachments->concat($patient->attachments);
                        }
                    @endphp
                    @foreach ($attachments as $attachment)
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
</x-layouts.app>
