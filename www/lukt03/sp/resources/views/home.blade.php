<x-app-layout>
    <x-slot:header>
        <x-header-heading>
            {{ __('Sháním hlídání') }}
        </x-header-heading>
    </x-slot>

    @auth
        @if (!auth()->user()->hasVerifiedEmail())
            <x-alert type="info">
                <p class="font-bold">
                    {{ __('Váš účet je téměř připravený') }}
                </p>
                <p class="text-sm">
                    {{ __('Než budeme pokračovat, klikněte prosím na odkaz, který najdete ve své e-mailové schránce.') }}
                </p>
            </x-alert>
        @elseif (request('verified'))
            <x-alert type="success">
                <p class="font-bold">
                    {{ __('Váš e-mail byl ověřen') }}
                </p>
                <p class="text-sm">
                    {{ __('Nyní můžete přidat své mazlíčky a najít pro ně vhodné hlídání, nebo nabídnout hlídání jiným.') }}
                </p>
            </x-alert>
        @endif
    @endauth

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Tady něco bude') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
