<section class="flex gap-8 text-gray-900">
	<div class="shrink-0">
		<img src="{{ asset($cat->photo_url_with_placeholder) }}" :alt="__('Foto kočky')" class="w-32 h-32 object-contain rounded-lg">
	</div>
	<div class="leading-loose">
		<header>
			<h2 class="text-xl font-semibold">
				@if (request()->route()->named('kocky.index') || auth()->user()->isAdmin())
					<x-link href="{{ route('kocky.edit', ['cat' => $cat]) }}">
						{{ $cat->name }}
					</x-link>
				@else
					{{ $cat->name }}
				@endif
			</h2>
		</header>

		@if (isset($cat->birthday))
			<p>Stáří: {{ today()->longAbsoluteDiffForHumans($cat->birthday, 2) }}</p>
		@endif

		@if (isset($cat->details))
			<p>{{ $cat->details }}</p>
		@endif
	</div>
</section>
