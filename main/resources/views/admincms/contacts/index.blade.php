@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="title">Tous les contacts</h1>

        <div class="line-separation"></div>

        @if (!empty($contacts->count()))
            <div class="box__filter">
                <input type="text" name="posts-filter" id="posts-filter" class="form__input form__input--filter js__input-filter" placeholder="Filter">
            </div>

            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Motif</th>
                    <th>Date creation</th>
                    <th class="table-action">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->firstname .' '.$contact->lastname }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->motif }}</td>
                        <td>{{ $contact->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="actions t-center">
                            <a href="{{ route('office.contacts.show', $contact->id) }}" title="Voir contact">
                                <span class="icon icon-view">VOIR</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $contacts->links('vendor.pagination.bootstrap-4') }}
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
