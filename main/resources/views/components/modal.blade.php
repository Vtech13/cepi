<div class="modal" id="{{ $id }}">
    <div class="modal-bg modal-exit"></div>
    <div class="modal-container">
        {{ $slot }}

        <button class="modal-close modal-exit">
            <x-icon-svg :file="asset('img/icon/close-modal.svg')" name="close"/>
        </button>
    </div>
</div>
