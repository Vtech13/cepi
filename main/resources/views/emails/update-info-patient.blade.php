<x-layouts.email title="Nouvelle information patient | {{ config('app.name') }}">
    <p>Bonjour,</p>

    <p>
        Une nouvelle information a été ajoutée au patient {{ $patientLastname }} {{ $patientFirstname }} par {{ $confrereLastname }} {{ $confrereFirstname }}.
    </p>

    <p>
        <a href="{{ route('admin.patients.index') }}">
            {{ route('admin.patients.index') }}
        </a>
    </p>

    <p>
        Cordialement, <br>
        CliniqueCEPI
    </p>
</x-layouts.email>