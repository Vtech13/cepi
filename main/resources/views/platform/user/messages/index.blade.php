<!-- resources/views/messages/index.blade.php -->


<style>
ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

ul li:hover {
    background-color: #f5f5f5;
}

ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

ul li a:hover {
    color: #007BFF;
}

.select_destinataire{
    width: 30%;
}

.form__input{
        height: 100px!important;
    }
</style>

<x-layouts.app :class-body="'no-sidebar'" link-active="messages">

    <x-section>
        <div class="block-content">
            <h1>Chat</h1>
            <h2>Conversations</h2>
            <ul>
                @foreach ($groups as $group)
                    <li>
                        <a href="{{ route('user.messages.show', $group) }}">{{ $group->name }} | Objet : {{ $group->objet }}</a>
                    </li>
                @endforeach
            </ul>
<!--
            <h2>Nouveau Groupe</h2>
            <form action="{{ route('user.groups.store') }}" method="POST" class="form">
                @csrf
                <div class="form__group select_destinataire">
                    <label for="receiver_id">Destinataire(s):</label>
                    <select class="form__input form__input--select" name="confreres[]" id="receiver_id" multiple>
                        @foreach($confreres as $confrere)
                            @if($confrere->id != auth()->id())
                                <option value="{{ $confrere->id }}">{{ $confrere->firstname }} {{ $confrere->lastname }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button class="form__button" type="submit">Créer un groupe</button>
            </form> -->
        </div>
    </x-section>
</x-layouts.app>
