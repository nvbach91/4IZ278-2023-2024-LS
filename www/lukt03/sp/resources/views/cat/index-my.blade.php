<x-app-layout>
	<x-slot:title>{{ __('Moje kočky') }}</x-slot>

    <x-slot:header>
		<x-header-heading>
				{{ __('Moje kočky') }}
		</x-header-heading>
    </x-slot>

	@if (session('status') === 'cat-created')
		<x-alert type="success">
			<p class="font-bold">
				{{ __('Kočka byla přidána') }}
			</p>
		</x-alert>
	@elseif (session('status') === 'cat-updated')
		<x-alert type="success">
			<p class="font-bold">
				{{ __('Uloženo') }}
			</p>
		</x-alert>
	@endif

	<div class="py-12">
		<div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="flex justify-end">
				<form method="post">
					@csrf
					@method('get')

					<x-primary-button formaction="{{ route('kocky.create') }}">
						{{ __('Přidat kočku') }}
					</x-primary-button>
				</form>
			</div>

			{{ $cats->onEachSide(1)->links() }}
			@forelse ($cats as $cat)
				<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
					@include('cat.partials.cat-card')
				</div>
			@empty
				<div class="text-center">{{ __('Zatím žádné nemám.') }}</div>
			@endforelse
		</div>
	</div>
</x-app-layout>
