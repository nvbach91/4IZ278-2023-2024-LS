<x-app-layout>
    <x-slot:title>{{ __('Editace kočky') }}</x-slot>

    <x-slot:header>
        <x-link :href="url()->previous()">
			<x-entypo-chevron-left class="inline align-text-bottom !h-5" />{{ __('Zpět') }}
		</x-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Editace kočky') }}
                    </h2>
                    <form
                        method="post"
                        action="{{ request()->route()->named('kocky.create') ? route('kocky.store') : route('kocky.update', ['cat' => $cat]) }}"
                        enctype="multipart/form-data"
                        class="space-y-6"
                    >
                        @csrf
                        @if (request()->route()->named('kocky.edit'))
                            @method('patch')
                        @endif

                        <div>
                            <x-input-label for="name" :value="__('Jméno')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $cat->name)" maxlength="255" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="birthday" :value="__('Datum narození')" />
                            <x-text-input id="birthday" name="birthday" type="date" :max="today()->subDay()->toDateString()" class="mt-1 block w-full" :value="old('birthday', $cat->birthday?->format('Y-m-d'))" />
                            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
                        </div>

                        <div>
                            <x-input-label for="details" :value="__('Popis')" />
                            <x-textarea id="details" name="details" type="text" class="mt-1 block w-full" :value="old('details', $cat->details)" rows="3" maxlength="1000" />
                            <x-input-error class="mt-2" :messages="$errors->get('details')" />
                        </div>

                        <div>
                            <x-input-label for="photo" :value="__('Fotografie')" />
                            @isset($cat->photo_url)
                                <img src="{{ asset($cat->photo_url) }}" class="rounded-lg w-32 h-32 object-contain mt-2">
                                <div>
                                    <x-checkbox id="delete_photo" name="delete_photo">
                                        {{ __('Smazat fotografii') }}
                                    </x-checkbox>
                                </div>
                            @endisset
                            <input id="photo" name="photo" type="file" accept="image/*" class="mt-1 form-control @error('photo') is-invalid @enderror" :value="old('photo')" >
                            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Uložit') }}</x-primary-button>
                            @if (request()->route()->named('kocky.edit'))
                                <x-danger-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', {
                                        name: 'confirm-cat-deletion',
                                        title: '{{ __('Opravdu chcete smazat tuto kočku?')}}',
                                        action: '{{ route('kocky.destroy', ['cat' => $cat]) }}',
                                    })"
                                >{{ __('Smazat') }}</x-danger-button>
                            @endif
                        </div>
                    </form>
                </section>
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
