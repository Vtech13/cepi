<x-layouts.app :class-body="$class_body" :link-active="$link_active">
    <x-section>
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <h1>Confrères</h1>
            </div>
            <div class="col-xs-12 col-sm-4 col-jse">
                <a href="{{ route('admin.confreres.create') }}" class="btn btn--info mb-30">
                    Ajouter un confrère
                </a>
            </div>
        </div>

        <div class="block-content">
            <div class="search-block search-block--filter">
                <div class="form">
                    <x-form.input name="search" id="search-filter" placeholder="Filtrer"></x-form.input>
                </div>
            </div>

            <table class="table table-responsive" id="table">
                <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Date création</th>
                    <th>Dernière connection</th>
                    <th class="table-action">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($confreres as $confrere)
                    <tr>
                        <td>{{ $confrere->firstname }}</td>
                        <td>{{ $confrere->lastname }}</td>
                        <td>{{ $confrere->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if (!empty($confrere->login_at))
                                {{ $confrere->login_at->diffForHumans() }}
                            @elseif (!empty($confrere->login_link_sent_at))
                                Lien renvoyé {{ $confrere->login_link_sent_at->diffForHumans() }}
                            @else
                                <a href="{{ route('admin.confreres.sent-login-link', $confrere->id) }}">
                                    Renvoyer le lien de connection
                                </a>
                            @endif
                        </td>
                        <td class="actions t-center">
                            <a href="{{ route('admin.confreres.edit', $confrere->id) }}" title="Modifier">
                                <span class="icon icon-edit"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-section>
</x-layouts.app>
