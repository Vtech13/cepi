<x-layouts.login :class-body="$class_body">
    <x-section>
        <h1 class="t-center">Bonjour {{ $name }}, {{ $new ? 'création' : 'modification' }} de votre mot de passe</h1>

        <form action="{{ route('auth.reset-password.store', $token) }}" method="post" class="form">
            @csrf

            <x-form.input type="password" name="password" label="Mot de passe*" required></x-form.input>
            <x-form.input type="password" name="password_confirmation" label="Confirmation de votre mot de passe*"
                          required></x-form.input>

            <x-form.button>Enregistrer</x-form.button>
        </form>
    </x-section>
</x-layouts.login>
