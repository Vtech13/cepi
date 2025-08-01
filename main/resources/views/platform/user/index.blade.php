<x-layouts.app :class-body="$class_body" link-active="user">
    <x-section>
    <div class="row">
            <div class="col-xs-12 col-sm-8">
                <h1>Comptes rendus</h1>
            </div>
            <div class="col-xs-12 col-sm-4 col-jse">
                <a href="{{ route('user.patients.create') }}" class="btn btn--info mb-30">
                    Adresser un nouveau patient
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="search-block search-block--filter">
                <div class="form">
                    <x-form.input name="search" id="search-filter" placeholder="Filtrer"></x-form.input>
                </div>
            </div>

            <table class="table table-responsive table__compte-rendu" id="table">
                <thead>
                <tr>
                    <th>Document</th>
                    <th>Date ajout document</th>
                    <th class="table-action">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($user->attachments->merge($patients->pluck('attachments')->flatten()) as $attachment)                    <tr>
                        <td>{{ $attachment->name }}</td>
                        <td>{{ $attachment->created_at->format('d/m/Y H:i:s') }}</td>
                        <td class="actions t-center">
                            @if ($attachment->type === \App\Models\Attachment::TYPE_IMG)
                                <div class="js__lightbox-btn" data-type="img"
                                     data-url="{{ route('user.files.show', $attachment->id) }}">
                                    <span class="icon icon-view"></span>
                                </div>
                            @else
                                <a href="{{ route('user.files.show', $attachment->id) }}" target="_blank"
                                   title="Voir le fichier">
                                    <span class="icon icon-download-pdf"></span>
                                </a>
                            @endif
                            <form method="post" action="{{ route('user.files.download-one', $attachment->id) }}" class="form">
                                @csrf
                                <x-form.button class="btn--icon">
                                    <span class="icon icon-download"></span>
                                </x-form.button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-section>
</x-layouts.app>
