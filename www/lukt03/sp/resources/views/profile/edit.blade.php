<x-app-layout>
    <x-slot:title>{{ __('Nastavení účtu') }}</x-slot>

    <x-slot:header>
        <x-header-heading>
            {{ __('Nastavení účtu') }}
            @if (auth()->user()->id !== $user->id)
                <span class="uppercase before:content-['\00b7'] text-red-600">
                    {{ __('Cizí účet!') }}
                </span>
            @endif
        </x-header-heading>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            @if ($user->id === auth()->user()->id)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
