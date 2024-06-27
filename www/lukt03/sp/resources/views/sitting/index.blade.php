<x-app-layout>
	<x-slot:title>{{ __('Všechna hlídání') }}</x-slot>

    <x-slot:header>
        <x-header-heading>
            {{ __('Všechna hlídání') }}
        </x-header-heading>
    </x-slot>

	<div class="py-12">
		<div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<section>
					<header class="mb-6">
						{{ $sittings->onEachSide(1)->links() }}
					</header>
					<table class="w-full">
						<thead>
							<tr class="border-b">
								<th colspan="2" class="px-4 pt-0 pb-3 text-center">
									{{ __('Vlastník') }}
								</th>
								<th colspan="2" class="px-4 pt-0 pb-3 text-center">
									{{ __('Hlídač') }}
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
							</tr>
						</thead>
						<tbody>
							@forelse ($sittings as $sitting)
								@include('sitting.partials.index-row')
							@empty
								<td colspan="7" class="p-4 text-center">{{ __('Zatím tu nic není.') }}</td>
							@endforelse
						</tbody>
					</table>
				</section>
			</div>
		</div>
	</div>
</x-app-layout>
