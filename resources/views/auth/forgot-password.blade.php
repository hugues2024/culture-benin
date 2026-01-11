<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<style>
    /* Couleur de sélection pour Chrome, Firefox, Safari et Edge */
    ::selection {
        background-color: rgba(0, 135, 81, 0.25); /* Vert bénin avec 25% d'opacité */
        color: #008751; /* Le texte lui-même devient vert foncé */
    }

    /* Pour Firefox (version spécifique) */
    ::-moz-selection {
        background-color: rgba(0, 135, 81, 0.25);
        color: #008751;
    }
</style>