@extends('layouts.admin')

@section('content')
    <div class="container">

        <h1 class="title">Editer une fiche conseil</h1>

        <form action="{{ route('office.advice-files.update', $file->id) }}" method="post" class="form"
              enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form__block">
                <label for="name" class="form__label">Nom</label>
                <input type="text" class="form__input" name="name" id="name" required
                       value="{{ empty(old('name')) ? $file->name : old('name') }}">
                @if ($errors->has('name'))
                    <div class="form__field-error">{{ $errors->first('name') }}</div>
                @endif
            </div>

            <div class="form__block">
                <a href="{{ asset("storage/advice-files/$file->file") }}" target="_blank">Voir le PDF</a>
            </div>

            <div class="form__block">
                <label for="file" class="form__label">Changer le PDF</label>
                <input type="file" name="file" class="form__input" id="file">
                @if ($errors->has('file'))
                    <div class="form__field-error">{{ $errors->first('file') }}</div>
                @endif
            </div>

            <button type="submit" class="form__submit">Valider</button>
        </form>

        <form action="{{ route('office.advice-files.destroy', $file->id) }}" method="post" class="form">
            @csrf
            @method('delete')

            <button type="submit" class="form__submit form__submit--delete js__btn-confirm"
                    data-confirm="Êtes vous sur de vouloir supprimer ?">Supprimer
            </button>
        </form>
    </div>
@endsection

