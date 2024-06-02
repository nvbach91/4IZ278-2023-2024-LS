<x-guest-layout>
    <x-slot:title>{{ __('Ověření účtu') }}</x-slot>

    <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-4">
        {{ __('Ověření účtu') }}
    </h2>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Váš účet je téměř připraven. Než budeme pokračovat, klikněte prosím na odkaz v e-mailu, který jsme Vám poslali. Pokud ve schránce žádný e-mail nevidíte, můžeme Vám poslat nový.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Na e-mail, který jste zadali při založení účtu, jsme poslali nový ověřovací odkaz.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Znovu poslat ověřovací e-mail') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Odhlásit se') }}
            </button>
        </form>
    </div>
</x-guest-layout>
