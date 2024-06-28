<x-guest-layout>
    <x-slot:title>{{ __('Zapomenuté heslo') }}</x-slot>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-4">
        {{ __('Zapomenuté heslo') }}
    </h2>

    <div class="mb-4 text-sm text-gray-600">
        {!! __('Zapomněli jste své heslo? Buďte bez obav. Po vyplnění Vašeho e-mailu, který u&nbsp;nás máte uložený, Vám na něj pošleme odkaz. S&nbsp;ním si můžete zvolit nové heslo.') !!}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Poslat odkaz na změnu hesla') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
