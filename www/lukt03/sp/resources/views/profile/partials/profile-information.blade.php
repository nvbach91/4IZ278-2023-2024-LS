<section class="flex gap-6 text-gray-900">
	<div class="shrink-0">
		<img src="{{ $photo_url }}" class="w-32 rounded-lg">
	</div>
	<div class="leading-loose">
		<header>
			<h2 class="text-xl font-semibold">
				{{ $name }}
			</h2>
		</header>

		@if ($hidden)
			<p class="text-sm text-gray-600">{{ __('Skrytý profil') }}</p>
		@endif

		<p>{{ __('Registrace od') . ': ' . $joined }}</p>

		@if (isset($location))
			<p><x-entypo-location-pin left class="inline align-text-bottom !h-5" />{{ $location }}</p>
		@endif
	</div>
</section>
