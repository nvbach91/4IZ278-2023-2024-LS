<x-app-layout>
	<x-slot:title>{{ __('Moje hlídání') }}</x-slot>

    <x-slot:header>
		<x-header-heading>
				{{ __('Moje hlídání') }}
		</x-header-heading>
    </x-slot>

	@if (session('status') === 'sitting-created')
		<x-alert type="success">
			<p class="font-bold">
				{{ __('Žádost o hlídání byla odeslána') }}
			</p>
		</x-alert>
	@elseif (session('status') === 'sitting-confirmed')
		<x-alert type="success">
			<p class="font-bold">
				{{ __('Termín hlídání byl potvrzen') }}
			</p>
		</x-alert>
	@elseif (session('status') === 'sitting-deleted')
		<x-alert type="success">
			<p class="font-bold">
				{{ __('Termín hlídání byl zrušen') }}
			</p>
		</x-alert>
	@endif

	<div class="py-12">
		<div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<section class="px-4 sm:px-8 flex text-center gap-3">
				<div>
					<strong>{{ __('Stav:') }}</strong>
				</div>
				<div class="flex-auto">
					<x-entypo-hour-glass alt="{{ __('Čeká na schválení') }}" class="inline align-text-bottom !h-5" />
					{{ __('Čeká na schválení') }}
				</div>
				<div class="flex-auto">
					<x-entypo-check alt="{{ __('Potvrzeno') }}" class="inline align-text-bottom !h-5" />
					{{ __('Potvrzeno') }}
				</div>
				<div class="flex-auto">
					<x-entypo-cross alt="{{ __('Zrušeno') }}" class="inline align-text-bottom !h-5" />
					{{ __('Zrušeno') }}
				</div>
			</section>
			<section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<header>
					<h2 class="text-lg font-medium text-gray-900">
						{{ __('Hlídání mých koček') }}
					</h2>
				</header>
				<table class="w-full mt-5">
					<thead>
						<tr class="border-b">
							<th colspan="2" class="px-4 pt-0 pb-3 text-center">
								{{ __('Kdo hlídá') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('E-mail') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Od') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Do') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Stav') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Akce') }}
							</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($sittingsAsOwner as $sitting)
							@include('sitting.partials.index-my-row', ['user' => $sitting->sitter])
						@empty
							<td colspan="7" class="p-4 text-center">{{ __('Zatím tu nic není.') }}</td>
						@endforelse
					</tbody>
				</table>
			</section>

			<section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<header>
					<h2 class="text-lg font-medium text-gray-900">
						{{ __('Komu hlídám') }}
					</h2>
				</header>
				<table class="w-full mt-5">
					<thead>
						<tr class="border-b">
							<th colspan="2" class="px-4 pt-0 pb-3 text-center">
								{{ __('Komu hlídám') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('E-mail') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Od') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Do') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Stav') }}
							</th>
							<th class="px-4 pt-0 pb-3 text-center">
								{{ __('Akce') }}
							</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($sittingsAsSitter as $sitting)
							@include('sitting.partials.index-my-row', ['user' => $sitting->owner])
						@empty
							<td colspan="7" class="p-4 text-center">{{ __('Zatím tu nic není.') }}</td>
						@endforelse
					</tbody>
				</table>
			</section>
		</div>
	</div>

	<form id="confirm-sitting" method="post">
		@csrf
		@method('patch')
	</form>

	<x-modal name="confirm-sitting-deletion" focusable>
        <form method="post" x-bind:action="action" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900" x-text="title"></h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Zpět') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Zrušit hlídání') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
