<x-layouts.email title="Création de compte | {{ config('app.name') }}">
    <p>Bonjour,</p>

    <p>
        Votre compte a été crée sur {{ config('app.name') }}, pour l'activer veuillez créer votre mot de passe en
        cliquant sur le lien ci-dessous :
    </p>

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
