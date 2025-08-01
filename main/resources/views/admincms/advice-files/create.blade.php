@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="title">Créer une fiche conseil</h1>

        <form action="{{ route('office.advice-files.store') }}" method="post" class="form" enctype="multipart/form-data">
            @csrf

            <div class="form__block">
                <label for="name" class="form__label">Nom</label>
                <input type="text" class="form__input" name="name" id="name" required value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <div class="form__field-error">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form__block">
                <label for="file" class="form__label">Pdf</label>
                <input type="file" name="file" class="form__input" id="file">
                @if ($errors->has('file'))
                    <div class="form__field-error">{{ $errors->first('file') }}</div>
                @endif
            </div>

            <button type="submit" class="form__submit">Ajouter</button>
        </form>
    </div>
@endsection

