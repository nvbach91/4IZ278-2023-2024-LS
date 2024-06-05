<x-app-layout>
	<x-slot:title>{{ __('Profil kočičí chůvy') }}</x-slot>

    <x-slot:header>
        <x-link :href="url()->previous()">
			<x-entypo-chevron-left class="inline align-text-bottom !h-5" />{{ __('Zpět') }}
		</x-link>
    </x-slot>

	<div class="py-12">
		<div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<div class="max-w-xl">
					@include('profile.partials.profile-information')
				</div>
			</div>

			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<div class="max-w-xl">
					@include('profile.partials.sitting-availability')
				</div>
			</div>

			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<div class="max-w-xl">
					@include('profile.partials.cats')
				</div>
			</div>

			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<div class="max-w-xl">
					@include('profile.partials.reviews')
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
