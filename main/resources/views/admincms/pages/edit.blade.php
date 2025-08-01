@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="title">Modifier {{ $page->name }}</h1>

        @if ($user->isSuAdmin)
            <a href="#" class="js__toggle-btn" data-key="1">
                Ajouter un block
            </a>

            <div class="js__toggle-value-1 form__block-page d_none">
                <form action="{{ route('office.blocks.store') }}" method="post" class="form">
                    @csrf

                    <input type="hidden" name="page_id" value="{{ $page->id }}">

                    <div class="form__block">
                        <label for="name" class="form__label">Name</label>
                        <input type="text" name="name" class="form__input" id="name">
                    </div>

                    <div class="form__block">
                        <label for="title" class="form__label">Title</label>
                        <input type="text" name="title" class="form__input" id="title">
                    </div>

                    <div class="form__block">
                        <label for="content" class="form__label">Content</label>
                        <textarea name="content" id="content" class="form__input--textarea textarea-editor"></textarea>
                    </div>

                    <button type="submit" class="form__submit">Valider</button>
                </form>
            </div>

            <div class="line-separation"></div>
        @endif

        <div class="pages__all-blocks">
            @if ($page->name !== 'video-utiles')
                @foreach ($page->blocks as $k => $v)
                    <p class="pages__all-blocks-title">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $v->name)) }}</p>

                    <div class="form__block-page">
                        <form action="{{ route('office.blocks.update', $v->id) }}" method="post" class="form"
                              enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <input type="hidden" name="page_id_{{ $v->id }}" value="{{ $page->id }}">

                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    @if ($user->isSuAdmin)
                                        <div class="form__block">
                                            <label for="name_{{ $v->id }}" class="form__label">Name</label>
                                            <input type="text" name="name_{{ $v->id }}" class="form__input"
                                                   id="name_{{ $v->id }}"
                                                   value="{{ empty(old('name_'.$v->id)) ? $v->name : old('name_'.$v->id) }}">
                                        </div>
                                    @endif

                                    <div class="form__block">
                                        <label for="title_{{ $v->id }}" class="form__label">Title</label>
                                        <input type="text" name="title_{{ $v->id }}" class="form__input"
                                               id="title_{{ $v->id }}"
                                               value="{{ empty(old('title_'.$v->id)) ? $v->title : old('title_'.$v->id) }}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    @if ($user->isSuAdmin)
                                        <div class="form__block">
                                            <label for="image_{{ $v->id }}" class="form__label">Image (jpg, png)</label>
                                            <input type="file" name="image_{{ $v->id }}" class="form__input"
                                                   id="image_{{ $v->id }}">
                                            @if ($errors->has('image_'.$v->id))
                                                <div
                                                    class="form__field-error">{{ $errors->first('image_'.$v->id) }}</div>
                                            @endif
                                        </div>
                                    @else
                                        @if (!empty($v->attachments->first()) || str_contains($v->name, 'equipe'))
                                            <div class="form__block">
                                                <label for="image_{{ $v->id }}" class="form__label">Image (jpg,
                                                    png)</label>
                                                <input type="file" name="image_{{ $v->id }}" class="form__input"
                                                       id="image_{{ $v->id }}">
                                                @if ($errors->has('image_'.$v->id))
                                                    <div
                                                        class="form__field-error">{{ $errors->first('image_'.$v->id) }}</div>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="form__block">
                                <label for="content_{{ $v->id }}" class="form__label">Content</label>
                                <textarea name="content_{{ $v->id }}" id="content_{{ $v->id }}"
                                          class="form__input--textarea textarea-editor">
                                    {!! empty(old('content_'.$v->id)) ? $v->content : old('content_'.$v->id) !!}
                                </textarea>
                            </div>

                            @if (!empty($v->attachments->first()))
                                @if ($v->attachments->first()->isImage)
                                    <div class="line-separation"></div>

                                    <div class="block-media block-media__{{ $v->attachments->first()->id }}">
                                        <img src="{{ $v->attachments->first()->urlCache }}" alt="" class="img-fluid">

                                        @if ($user->isSuAdmin || str_contains($v->name, 'equipe'))
                                            <a href="#" class="js__delete-attachment"
                                               data-url="{{ route('office.attachments.destroy', $v->attachments->first()->id) }}"
                                               data-class="block-media__{{ $v->attachments->first()->id }}">
                                                Supprimer l'image
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            @endif

                            <button type="submit" class="form__submit">Valider</button>

                        </form>
                    </div>

                    <div class="line-separation"></div>
                @endforeach
            @else
                @foreach ($page->blocks as $k => $v)
                    <p class="pages__all-blocks-title">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $v->name)) }}</p>

                    <div class="form__block-page">
                        <form action="{{ route('office.blocks.update', $v->id) }}" method="post" class="form">
                            @method('put')
                            @csrf

                            <input type="hidden" name="page_id_{{ $v->id }}" value="{{ $page->id }}">

                            @if ($user->isSuAdmin)
                                <div class="form__block">
                                    <label for="name_{{ $v->id }}" class="form__label">Name</label>
                                    <input type="text" name="name_{{ $v->id }}" class="form__input"
                                           id="name_{{ $v->id }}"
                                           value="{{ empty(old('name_'.$v->id)) ? $v->name : old('name_'.$v->id) }}">
                                </div>
                            @endif

                            <div class="form__block">
                                <label for="title_{{ $v->id }}" class="form__label">Title</label>
                                <input type="text" name="title_{{ $v->id }}" class="form__input"
                                       id="title_{{ $v->id }}"
                                       value="{{ empty(old('title_'.$v->id)) ? $v->title : old('title_'.$v->id) }}">
                            </div>

                            @if ($v->name !== 'main_title')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form__block">
                                            <label for="mov_{{ $v->id }}" class="form__label">Video url (ex:
                                                https://youtu.be/xxxxxxxx)</label>
                                            <input type="text" name="mov_{{ $v->id }}" class="form__input"
                                                   id="mov_{{ $v->id }}">
                                            @if ($errors->has('mov_'.$v->id))
                                                <div class="form__field-error">{{ $errors->first('mov_'.$v->id) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form__block">
                                            <label for="mov_title_{{ $v->id }}" class="form__label">Video titre</label>
                                            <input type="text" name="mov_title_{{ $v->id }}" class="form__input"
                                                   id="mov_title_{{ $v->id }}">
                                            @if ($errors->has('mov_title_'.$v->id))
                                                <div
                                                    class="form__field-error">{{ $errors->first('mov_title_'.$v->id) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($v->attachments()->exists())
                                <div class="row">
                                    @foreach ($v->attachments as $attachment)
                                        <div class="col-xs-4 block-media__{{ $attachment->id }}">
                                            @if ($attachment->isVideo)
                                                <p>{{ $attachment->title }}</p>
                                                <iframe width="100%" height="260"
                                                        src="https://www.youtube-nocookie.com/embed/{{ $attachment->name }}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen></iframe>

                                                <a href="#" class="js__delete-attachment"
                                                   data-url="{{ route('office.attachments.destroy', $attachment->id) }}"
                                                   data-class="block-media__{{ $attachment->id }}">
                                                    Supprimer la video
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <div class="line-separation"></div>
                            @endif

                            <button type="submit" class="form__submit">Valider</button>

                        </form>
                    </div>

                    <div class="line-separation"></div>
                @endforeach
            @endif
        </div>

    </div>
@endsection

@section('js')
    <script src="{{ asset('js/vendor/ckeditor5/build/ckeditor.js') }}" defer></script>
@endsection
