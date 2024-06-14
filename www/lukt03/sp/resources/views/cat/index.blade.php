<x-app-layout>
	<x-slot:title>{{ __('Všechny kočky') }}</x-slot>

    <x-slot:header>
        <x-header-heading>
            {{ __('Všechny kočky') }}
        </x-header-heading>
    </x-slot>

	@if (session('status') === 'cat-deleted')
		<x-alert type="success">
			<p class="font-bold">
				{{ __('Kočka :name byla smazána', ['name' => session('name')]) }}
			</p>
		</x-alert>
	@endif

	<div class="py-12">
		<div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<section>
					<header class="mb-6">
						{{ $cats->onEachSide(1)->links() }}
					</header>
					<table class="w-full">
						<thead>
							<tr class="border-b">
								<th></th>
								<th class="px-4 pt-0 pb-3 text-start">
									{{ __('Jméno') }}
								</th>
								<th class="px-4 pt-0 pb-3 text-start">
									{{ __('Vlastník') }}
								</th>
								<th class="px-4 pt-0 pb-3 text-start">
									{{ __('Popis') }}
								</th>
								<th class="px-4 pt-0 pb-3 text-center">
									{{ __('Akce') }}
								</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($cats as $cat)
								@include('cat.partials.index-row')
							@empty
								<td colspan="5" class="p-4 text-center">{{ __('Zatím tu nic není.') }}</td>
							@endforelse
						</tbody>
					</table>
				</section>
			</div>
		</div>
	</div>

	<form id="edit-cat" method="post">
		@csrf
		@method('get')
	</form>

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
