<x-app-layout>
    <x-slot:title>{{ __('Editace termínu') }}</x-slot>

    <x-slot:header>
        <x-link :href="url()->previous()">
			<x-entypo-chevron-left class="inline align-text-bottom !h-5" />{{ __('Zpět') }}
		</x-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Editace termínu') }}
                        </h2>
                        <form
                            method="post"
                            action="{{ request()->route()->named('dostupnost.create') ? route('dostupnost.store') : route('dostupnost.update', ['event' => $event]) }}"
                            class="space-y-6"
                        >
                            @csrf
                            @if (request()->route()->named('dostupnost.edit'))
                                @method('patch')
                            @endif

                            <div class="flex flex-row gap-8">
                                <div class="basis-1/2">
                                    <x-input-label for="start" :value="__('Od')" />
                                    <x-text-input id="start" name="start" type="datetime-local" class="mt-1 block w-full" :value="old('start', $event->start)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('start')" />
                                </div>

                                <div class="basis-1/2">
                                    <x-input-label for="end" :value="__('Do')" />
                                    <x-text-input id="end" name="end" type="datetime-local" class="mt-1 block w-full" :value="old('end', $event->end)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('end')" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Uložit') }}</x-primary-button>
                                @if (request()->route()->named('dostupnost.edit'))
                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', {
                                            name: 'confirm-event-deletion',
                                            title: '{{ __('Opravdu chcete smazat tuto událost?')}}',
                                            action: '{{ route('dostupnost.destroy', ['event' => $event]) }}',
                                        })"
                                    >{{ __('Smazat') }}</x-danger-button>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="confirm-cat-deletion" focusable>
        <form method="post" x-bind:action="action" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900" x-text="title"></h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Zpět') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Smazat kočku') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
