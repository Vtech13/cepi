@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="title">Modifier article</h1>

        <form action="{{ route('office.posts.update', $post->id) }}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="form__block">
                        <label for="title" class="form__label">Titre</label>
                        <input type="text" class="form__input" name="title" id="title" value="{{ empty(old('title')) ? $post->title : old('title') }}" required>
                        @if ($errors->has('title'))
                            <div class="form__field-error">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="form__block">
                        <label for="category" class="form__label">Category</label>
                        <select name="post_category_id" id="category">
                            <option value="">Pas de categorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $post->post_category_id === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="form__block">
                        <label for="content" class="form__label">Content</label>
                        <textarea name="content" id="content"
                                  class="form__input form__input--textarea textarea-editor">
                            {!! $post->content !!}
                        </textarea>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form__block">
                        <label for="image" class="form__label">Image</label>
                        <input type="file" name="image" class="form__input" id="image">
                        @if ($errors->has('image'))
                            <div class="form__field-error">{{ $errors->first('image') }}</div>
                        @endif
                    </div>

                    @if ($post->attachments()->exists())
                        @if ($post->attachments()->first()->isImage)
                            <div class="line-separation"></div>
                            <div class="block-media">
                                <img src="{{ $post->attachments()->first()->urlCache }}" alt="" class="img-fluid">
                            </div>

                            <a href="#" id="js-delete-attachment" class="js-delete-attachment">
                                Supprimer l'image
                            </a>
                        @endif
                    @endif

                </div>
            </div>

            <button type="submit" class="form__submit">Valider</button>
        </form>

        <form action="{{ route('office.posts.destroy', $post->id) }}" method="post" class="form">
            @csrf
            @method('delete')

            <button type="submit" class="form__submit form__submit--delete js__btn-confirm" data-confirm="Êtes vous sur de vouloir supprimer ?">Supprimer</button>
        </form>

        <form action="{{ route('office.posts.destroy-attachment', $post->id) }}" method="post" id="destroy-attachment" class="d_none">
            @csrf
            @method('delete')
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/vendor/ckeditor5/build/ckeditor.js') }}" defer></script>
@endsection
