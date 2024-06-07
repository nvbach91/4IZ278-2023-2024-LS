<x-app-layout>
	<x-slot:title>{{ __('Všechny účty') }}</x-slot>

    <x-slot:header>
        <x-header-heading>
            {{ __('Všechny účty') }}
        </x-header-heading>
    </x-slot>

	@if (session('status') === 'profile-deleted')
		<x-alert type="success">
			<p class="font-bold">
				{{ __('Účet :email byl smazán', ['email' => session('email')]) }}
			</p>
		</x-alert>
	@endif

	<div class="py-12">
		<div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<table class="w-full">
					<thead>
						<tr class="border-b">
							<th></th>
							<th class="px-4 pt-0 pb-3 text-start">
								{{ __('Jméno') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-start">
								{{ __('E-mail') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-start">
								{{ __('Lokalita') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Neověřený') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Zveřejněný') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Akce') }}
							</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($users as $user)
							@include('profile.partials.index-row')
						@empty
							<td colspan="5" class="p-4 text-center">{{ __('Zatím tu nic není.') }}</td>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<form id="edit-profile" method="post">
		@csrf
		@method('get')
	</form>

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
</x-app-layout>
