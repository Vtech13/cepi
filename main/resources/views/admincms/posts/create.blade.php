@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="title">Créer un article</h1>

        <form action="{{ route('office.posts.store') }}" method="post" class="form" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="form__block">
                        <label for="title" class="form__label">Titre</label>
                        <input type="text" class="form__input" name="title" id="title" value="{{ old('title') }}" required>
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
                                <option value="{{ $category->id }}" {{ old('post_category_id') === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="form__block">
                        <label for="content" class="form__label">Content</label>
                        <textarea name="content" id="content" class="form__input form__input--textarea textarea-editor"></textarea>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form__block">
                        <label for="image" class="form__label">Image</label>
                        <input type="file" name="image" class="form__input" id="image">
                    </div>
                </div>
            </div>

            <button type="submit" class="form__submit">Ajouter</button>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/vendor/ckeditor5/build/ckeditor.js') }}" defer></script>
@endsection
