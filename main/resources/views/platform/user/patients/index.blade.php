<style>
    .js__delete-patient{
        min-width: 25px!important;
        margin: 0!important;
        padding: 0!important;
    }
</style>

<x-layouts.app :class-body="$class_body" link-active="patients">
    <x-section>
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <h1>Patients</h1>
            </div>
            <div class="col-xs-12 col-sm-4 col-jse">
                <a href="{{ route('user.patients.create') }}" class="btn btn--info mb-30">
                    Adresser un nouveau patient
                </a>
            </div>
        </div>

        <div class="block-content">
        <div class="search-block search-block--filter" style="display: flex;flex-direction: row;">
                <div class="form">
                    <x-form.input name="search" id="search-filter" placeholder="Filtrer"></x-form.input>
                </div>
                <img class="croix" src="/img/icon/close.svg" style="width: 32px;height: 32px; margin-left: 20px; margin-top: 5px; display: none;"></img>
            </div>

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
                @foreach($patients as $patient)
                    <tr>
                        <td>{{ $patient->firstname }}</td>
                        <td>{{ $patient->lastname }}</td>
                        <td>{{ \App\Models\Patient::MOTIFS[$patient->motif] }}</td>
                        <td>{{ \App\Enums\PatientStatus::STATUSES[$patient->status] }}</td>
                        <td class="actions t-center" style="display:flex;">
                            <a href="{{ route('user.patients.edit', $patient->id) }}" title="Modifier">
                                <span class="icon icon-edit"></span>
                            </a>
                            @if (!empty($patient))
                                <form action="{{ route('user.patients.destroy', $patient->id) }}" method="post" class="form"
                                    id="delete-patient">
                                    @csrf
                                    @method('delete')
                                    <x-form.button class="btn--link js__delete-patient" data-id="delete-patient">
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
