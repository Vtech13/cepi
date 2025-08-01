<x-layouts.login class-body="{{ $class_body }}">
    <x-section>
        <div class="platform-info">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo.png') }}" alt="" class="img-fluid">
            </a>
        </div>

        <form action="{{ route('login.authenticate') }}" method="post" class="form form--login">
            @csrf

            <x-form.input type="email" name="email" id="email" label="Email" required></x-form.input>
            <x-form.input type="password" name="password" id="password" label="Mot de passe" required></x-form.input>

            <x-form.button>Se connecter</x-form.button>
        </form>

        <div class="t-center mt-30">
            <button class="btn btn--link" id="forgot-password" data-target="container-forgot-password">Mot de passe oublié ?</button>
        </div>

        <div id="container-forgot-password" class="@if (!$errors->first('email-recover')) d_none @endif">
            <form action="{{ route('auth.recover-password') }}" method="post" class="form">
                @csrf
                <x-form.input type="email" name="email-recover" id="email-recover" label="Email" required></x-form.input>
                <x-form.button>Récupérer le mot de passe</x-form.button>
            </form>
        </div>
    </x-section>
</x-layouts.login>
