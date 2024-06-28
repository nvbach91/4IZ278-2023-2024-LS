<x-guest-layout>
    <x-slot:title>{{ __('Přihlásit se') }}</x-slot>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-4">
        {{ __('Přihlásit se') }}
    </h2>    

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Heslo')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <x-checkbox id="remember_me" name="remember">
                {{ __('Zapamatovat si přihlášení') }}
            </x-checkbox>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <x-link class="text-sm" href="{{ route('password.request') }}">
                    {{ __('Zapomenuté heslo?') }}
                </x-link>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Přihlásit se') }}
            </x-primary-button>
        </div>
    </form>
    <div class="flex justify-center mt-4 pt-2 border-t border-gray-200">
        <x-link href="{{ route('register') }}">
            {{ __('Vytvořit nový účet') }}
        </x-link>
    </div>
</x-guest-layout>
