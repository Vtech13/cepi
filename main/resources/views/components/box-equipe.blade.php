@if (!empty($block->title) || !empty($block->content) || !empty($block->image))
    <div class="box-equipe">
        <a href="#" class="box-equipe__link" data-modal="team-{{ $block->id }}">
            @if (!empty($block->image))
                <div class="box-equipe__img">
                    <img src="{{ $block->image->urlBigCache }}" alt="" class="img-fluid">
                </div>
            @endif
            <p class="box-equipe__title">{{ $block->title }}</p>
        </a>

        <x-modal id="team-{{ $block->id }}">
            {!! $block->content !!}
        </x-modal>
    </div>
@endif
