@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="title">Créer une category</h1>

        <form action="{{ route('office.posts-categories.store') }}" method="post" class="form">
            @csrf

            <div class="form__block">
                <label for="name" class="form__label">Nom</label>
                <input type="text" class="form__input" name="name" id="name" required value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <div class="form__field-error">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <button type="submit" class="form__submit">Ajouter</button>
        </form>
    </div>
@endsection

