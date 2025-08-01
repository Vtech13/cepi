<x-layouts.email title="Nouveau patient | {{ config('app.name') }}">
    <p>Bonjour,</p>

    <p>
        Un nouveau patient ({{ $patientName }}) vous à été adressé par {{ $confrereName }}.
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
