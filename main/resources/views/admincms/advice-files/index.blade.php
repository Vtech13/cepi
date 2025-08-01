@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="title">Toutes les fiches conseils</h1>

        <div class="action action__add">
            <a href="{{ route('office.advice-files.create') }}">
                Ajouter une fiche
            </a>
        </div>

        <div class="line-separation"></div>

        @if (!empty($files->count()))
            <div class="box__filter">
                <input type="text" name="advice-files-filter" id="advice-files-filter" class="form__input form__input--filter js__input-filter" placeholder="Filter">
            </div>

            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date creation</th>
                    <th class="table-action">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($files as $file)
                    <tr>
                        <td>{{ $file->id }}</td>
                        <td>{{ $file->name }}</td>
                        <td>{{ $file->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="actions t-center">
                            <a href="{{ route('office.advice-files.edit', $file->id) }}" title="Edit fiche">
                                <span class="icon icon-edit">EDIT</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@section('js')
    <script>
        document.querySelectorAll('.table-responsive').forEach(function (table) {
            let labels = Array.from(table.querySelectorAll('th')).map(function (th) {
                return th.innerText
            })
            table.querySelectorAll('td').forEach(function (td, i) {
                td.setAttribute('data-label', labels[i % labels.length])
            })
        })
    </script>
@endsection
