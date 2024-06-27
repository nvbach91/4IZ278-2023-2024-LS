<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Osobní údaje') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Zde si můžete upravit svůj profil, nebo změnit e-mailovou adresu.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form
        method="post"
        action="{{ request()->route()->named('profil.edit') ? route('profil.update') : route('profily.update', ['user' => $user]) }}"
        enctype="multipart/form-data"
        class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Jméno')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" maxlength="255" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        @if ($user->id === auth()->user()->id)
            <div>
                <x-input-label for="email" :value="__('E-mail')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" maxlength="255" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Váš e-mail není ověřený.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Klikněte zde pro opětovné odeslání ověřovacího e-mailu.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('Na váš e-mail byl poslán nový ověřovací odkaz.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        @else
            <div>
                <x-input-label for="email" :value="__('E-mail')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" disabled />
            </div>
        @endif

        <div>
            <x-input-label for="location" :value="__('Lokalita')" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $user->location)" maxlength="255" autocomplete="address-level2" />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>

        <div class="space-y-1">
            <x-input-label for="avatar" :value="__('Fotografie')" />
            @isset($user->avatar_url)
                <img src="{{ asset($user->avatar_url) }}" :alt="__('Avatar profilu')" class="rounded-lg w-32 h-32 object-contain mt-1">
                <div>
                    <x-checkbox id="delete_avatar" name="delete_avatar">
                        {{ __('Smazat fotografii') }}
                    </x-checkbox>
                </div>
            @endisset
            <input id="avatar" name="avatar" type="file" accept="image/*" class="form-control @error('avatar') is-invalid @enderror" :value="old('avatar')" autocomplete="avatar">
            <x-input-error class="mt-1" :messages="$errors->get('avatar')" />
        </div>

        <div>
            <x-checkbox id="is_sitter" name="is_sitter" :checked="$user->isSitter()" :disabled="$user->isAdmin() || !$user->hasVerifiedEmail()">
                {{ __('Chci zveřejnit svůj profil a stát se kočičí chůvou') }}
            </x-checkbox>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Uložit') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Uloženo.') }}</p>
            @endif
        </div>
    </form>
</section>
