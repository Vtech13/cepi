<x-layouts.email title="Nouveaux documents | {{ config('app.name') }}">
    <p>Bonjour,</p>

    <p>
        De nouveaux documents sont disponible sur votre espace.
    </p>

    <p>
        <a href="{{ route('user.users') }}">
            {{ route('user.users') }}
        </a>
    </p>

    <p>
        Cordialement, <br>
        CliniqueCEPI
    </p>
</x-layouts.email>
