<x-layouts.app :class-body="'no-sidebar'" link-active="messages">
<style>
    /* Styles CSS (vous pouvez ajouter ces styles dans votre fichier CSS externe) */
    .message-container {
        max-width: 1050px;
        margin: 20px auto;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow-y: auto;
        max-height: 400px;
        padding: 10px;
        display: flex;
        flex-direction: column-reverse; /* Inverser l'ordre des éléments */
    }

    .container{
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .block-content{
        max-width: 1500px;
        width: 100%;
    }

    .message-list {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .message {
        margin-bottom: 10px;
    }

    .message-content {
        padding: 8px 12px;
        border-radius: 8px;
        display: inline-block;
        max-width: 70%;
        word-wrap: break-word; /* Assurez-vous que les longs messages ne débordent pas */
    }

    .sender .message-content {
        background-color: #edd8a7;
        float: left;
    }

    .receiver .message-content {
        background-color: #ffffff;
        float: right;
    }

    .message-content p {
        margin: 0;
    }

    .time {
        font-size: 12px;
        color: #777;
        display: block;
        text-align: right;
    }

    .no-messages {
        text-align: center;
    }

    .message-input {
        display: flex;
        margin-top: 20px;
    }

    .message-input textarea {
        flex: 1;
        resize: none;
    }

    .message-input button {
        margin-left: 10px;
    }

    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .file-label {
        display: inline-block;
        padding: 10px;
        background-color: var(--color-yellow);
        color: white;
        cursor: pointer;
        border-radius: 4px;
        margin-left: 10px;
        cursor: pointer;
        transition: opacity 0.3s ease-in-out, background-color 0.3s ease-in-out;
    }

    .form__group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1050px;
        width: 100%;
    }

    .text-input {
        flex-grow: 1;
        margin-right: 10px;
    }

    .form{
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form__input--textarea{
        min-height: 0!important;
    }
</style>

<script type="text/javascript">
    // Assurez-vous que ces valeurs sont passées au blade depuis votre contrôleur
    window.PusherConfig = {
        key: "{{ $pusherKey }}",
        cluster: "{{ $pusherCluster }}"
    };
    window.groupId = "{{ $groupId }}";
    window.userId = "{{ auth()->id() }}";
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<x-section>


<div class="block-content">

    <h1>Messages du groupe : {{ $group->name }}</h1>
    <h2> Objet du groupe : {{ $group->objet }}</h2>

    <div class="message-container">
            @if (count($messages) > 0)
            <ul class="message-list">
                @foreach ($messages as $message)
                    <li class="message {{ $message->user_id == auth()->id() ? 'sender' : 'receiver' }}">
                        <div class="message-content">
                            <small>
                                {{ $message->user_id == auth()->id() ? 'Moi' : $message->user->firstname . ' ' . $message->user->lastname }}
                            </small>
                            <p>{{ $message->content }}</p>
                            @if($message->file_path) <!-- Ajoutez ce bloc -->
                                <a href="{{ Storage::url($message->file_path) }}" download>Télécharger le fichier</a>
                            @endif
                            <span class="time">{{ \Carbon\Carbon::parse($message->created_at)->format('d-m-Y H:i:s A') }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
            @else
                <p class="no-messages">Aucun message trouvé.</p>
            @endif
        </div>

    <form id="message-form" action="{{ route('admin.messages.store', $group) }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <div class="form__group">
                <input type="hidden" name="group_id" value="{{ $groupId }}">
                <textarea class="form__input form__input--textarea" name="content" id="content" required></textarea>
                <input type="file" name="file" id="file" class="inputfile" /> <!-- Ajoutez ce champ -->
                <label for="file" class="file-label">
                    <i class="fas fa-paperclip"></i>
                </label>
            </div>
            <button class="form__button" type="submit">Envoyer</button>
        </form>
    </div>
</x-section>
</x-layouts.app>

<script src="{{ asset('js/messages.js') }}" defer></script>
