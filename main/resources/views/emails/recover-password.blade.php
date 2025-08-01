<x-layouts.email title="Changer mot de passe | {{ config('app.name') }}">
    <p>Bonjour,</p>

    <p>Vous avez demandé de changer votre mot de passe sur {{ config('app.name') }}.</p>

    <p>Cliquer sur le lien ci-dessous et suivez les instructions :</p>

    <p>
        <a href="{{ route('auth.reset-password', $token) }}">
            {{ route('auth.reset-password', $token) }}
        </a>
    </p>

    <p>
        Cordialement, <br>
        CliniqueCEPI
    </p>
</x-layouts.email>
