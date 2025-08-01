<style>
    .js__delete-patient{
        min-width: 25px!important;
        margin: 0!important;
        padding: 0!important;
    }
</style>

<script>
    window.onload = function() {
        var table = document.getElementById('table');
        var cells = table.getElementsByTagName('td');
        var searchInput = document.getElementById('search-filter');
        var clearSearch = document.getElementById('clearSearch');

        for (var i = 0; i < cells.length; i++) {
            cells[i].addEventListener('click', function() {
                var cellValue = this.textContent.trim();
                var cellIndex = this.cellIndex;
                var rows = table.getElementsByTagName('tr');

                for (var j = 1; j < rows.length; j++) { // start from 1 to avoid thead
                    var rowCells = rows[j].getElementsByTagName('td');
                    if (rowCells[cellIndex].textContent.trim() === cellValue) {
                        rows[j].style.display = '';
                    } else {
                        rows[j].style.display = 'none';
                    }
                }

                // Affiche la croix lorsque vous cliquez sur une cellule
                clearSearch.style.display = 'inline';
            });
        }

        searchInput.addEventListener('input', function() {
            clearSearch.style.display = this.value ? 'inline' : 'none';
        });

        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            this.style.display = 'none';

            // Réinitialisez le filtre ici
            var rows = document.getElementById('table').getElementsByTagName('tr');
            for (var i = 1; i < rows.length; i++) { // start from 1 to avoid thead
                rows[i].style.display = '';
            }
        });
    };
</script>

<x-layouts.app :class-body="$class_body" link-active="'patients">
    <x-section>
    <div class="row">
            <div class="col-xs-12 col-sm-8">
                <h1>Patients</h1>
            </div>
            <div class="col-xs-12 col-sm-4 col-jse">
                <a href="{{ route('admin.patients.create') }}" class="btn btn--info mb-30">
                    Ajouter un patient
                </a>
            </div>
        </div>

        <div class="block-content">
            <div class="search-block search-block--filter" style="display: flex;flex-direction: row;">
                <div class="form">
                    <x-form.input name="search" id="search-filter" placeholder="Filtrer"></x-form.input>
                </div>
                <img class="croix" id="clearSearch" src="/img/icon/close.svg" style="width: 32px;height: 32px; margin-left: 20px; margin-top: 5px; display: none;"></img>
            </div>

            <table class="table table-responsive" id="table">
                <thead>
                <tr>
                    <th>Confrère</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Motif</th>
                    <th>Statut</th>
                    <th class="table-action">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($patients as $index => $patient)
                    <tr class="data-row">
                        <td class="confrere" id="confrere">    
                            @if($patient->user)
                                {{ $patient->user->firstname . ' ' . $patient->user->lastname }}
                            @else
                                {{ 'Utilisateur non trouvé' }}
                            @endif
                        </td>
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
</x-layouts.app>
