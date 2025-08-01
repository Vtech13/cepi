<div class="attachment-preview__item" id="attachment-{{ $attachment->id }}">
    @if ($attachment->type === \App\Models\Attachment::TYPE_IMG)
        <div class="js__lightbox-btn" data-type="img" data-url="{{ route('admin.files.show', $attachment->id) }}">
            <img src="{{ route('admin.files.show', $attachment->id) }}" alt=""
                 class="img-fluid">
        </div>
        @if ($delete)
            <button type="button" class="btn btn--icon attachment-preview__link-delete js__attachment-delete"
                    data-id="{{ $attachment->id }}" data-url="{{ route('admin.files.destroy', $attachment->id) }}">
                <span class="icon icon-delete"></span>
            </button>
        @endif
    @endif
    @if ($attachment->type === \App\Models\Attachment::TYPE_PDF)
        <a href="{{ route('admin.files.show', $attachment->id) }}" target="_blank" class="attachment-preview__link-pdf">
            <span class="icon icon-download-pdf"></span>
            <span>{{ $attachment->name }}</span>
        </a>
            @if ($delete)
                <button type="button" class="btn btn--icon attachment-preview__link-delete js__attachment-delete"
                        data-id="{{ $attachment->id }}" data-url="{{ route('admin.files.destroy', $attachment->id) }}">
                    <span class="icon icon-delete"></span>
                </button>
            @endif
    @endif
</div>
