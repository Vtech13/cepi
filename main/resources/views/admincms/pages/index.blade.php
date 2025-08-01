@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="title">Toutes les pages</h1>

        <div class="action action__add">
            <a href="{{ route('office.advice-files.index') }}">
                Voir les fiches conseils
            </a>
        </div>

        <div class="line-separation"></div>

        @if (!empty($pages->count()))
            <div class="box__filter">
                <input type="text" name="pages-filter" id="pages-filter" class="form__input form__input--filter js__input-filter" placeholder="Filter">
            </div>

            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="table-action">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>{{ $page->name }}</td>
                        <td class="actions t-center">
                            <a href="{{ route('office.pages.edit', $page->id) }}" title="Edit page">
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
