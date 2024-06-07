<x-app-layout>
	<x-slot:title>{{ $user->name }}</x-slot>

    <x-slot:header>
        <x-link :href="url()->previous()">
			<x-entypo-chevron-left class="inline align-text-bottom !h-5" />{{ __('Zpět') }}
		</x-link>
    </x-slot>

	<div class="py-12">
		<div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
			@if (auth()->user()->isAdmin())
				<div class="flex justify-end gap-5">
					<form method="post">
						@csrf
						@method('get')

						<x-primary-button formaction="{{ route('profily.edit', ['user' => $user]) }}">
							{{ __('Upravit účet') }}
						</x-primary-button>
					</form>

					<x-danger-button
						x-data=""
						x-on:click.prevent="$dispatch('open-modal', {
							name: 'confirm-user-deletion',
							title: '{{ __('Opravdu chcete smazat účet :email?', ['email' => $user->email]) }}',
							action: '{{ route('profily.destroy', ['user' => $user]) }}',
						})"
					>{{ __('Smazat účet') }}</x-danger-button>
				</div>

				<x-modal name="confirm-user-deletion" focusable>
					<form method="post" x-bind:action="action" class="p-6">
						@csrf
						@method('delete')

						<h2 class="text-lg font-medium text-gray-900" x-text="title"></h2>

						<div class="mt-6 flex justify-end">
							<x-secondary-button x-on:click="$dispatch('close')">
								{{ __('Zpět') }}
							</x-secondary-button>

							<x-danger-button class="ms-3">
								{{ __('Smazat účet') }}
							</x-danger-button>
						</div>
					</form>
				</x-modal>
			@endif

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
