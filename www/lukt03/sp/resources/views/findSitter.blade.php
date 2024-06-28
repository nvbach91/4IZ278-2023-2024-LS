<x-app-layout>
    <x-slot:header>
        <x-header-heading>
            {{ __('Sháním hlídání') }}
        </x-header-heading>
    </x-slot>

    @auth
        @if (! auth()->user()->hasVerifiedEmail())
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
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <section>
                <header class="mb-6">
                    <form method="get">
                        <x-input-label for="location" :value="__('Lokalita:')" />
                        <x-text-input id="location" name="location" type="text" :value="app('request')->query('location')" maxlength="255" />
                        <x-primary-button class="mx-2">{{ __('Filtrovat') }}</x-primary-button>
                        <x-link :href="route('index')">{{ __('Zrušit filtry') }}</x-link>
                    </form>
                    {{ $sitters->onEachSide(1)->links() }}
                </header>
                <div class="grid grid-cols-3 gap-4">
                    @forelse ($sitters as $user)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <img src="{{ asset($user->avatarUrlWithPlaceholder) }}" :alt="__('Avatar profilu')" class="rounded-lg w-16 h-16 object-contain mt-2">
                            <h2 class="text-xl font-semibold">
                                <x-link :href="route('profily.show', ['user' => $user])">
                                    {{ $user->name }}
                                </x-link>
                            </h2>
			                <p>
                                <x-entypo-location-pin :alt="__('Lokalita')" class="inline align-text-bottom !h-5" />{{ $user->location }}
                            </p>
                            <p>
                                {{ count($user->pastSittingsAsSitter) }} uskutečněných hlídání
                            </p>
                            <p>
                                {{ __('Registrace od') . ': ' . $user->created_at->isoFormat('LL') }}
                            </p>
                        </div>
                    </div>
                    @empty
					{{ __('Parametrům nikdo neodpovídá.') }}
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
