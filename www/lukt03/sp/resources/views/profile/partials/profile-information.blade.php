<section class="flex gap-6 text-gray-900">
	<div class="shrink-0">
		<img src="{{ asset($user->avatar_url_with_placeholder) }}" :alt="__('Avatar profilu')" class="w-32 h-32 object-contain rounded-lg">
	</div>
	<div class="leading-loose">
		<header>
			<h2 class="text-xl font-semibold">
				{{ $user->name }}
			</h2>
		</header>

		@if ($user->isHidden())
			<p class="text-sm text-gray-600">{{ __('Skrytý profil') }}</p>
		@endif

		<p>{{ __('Registrace od') . ': ' . $user->created_at->isoFormat('LL') }}</p>

		@if (isset($user->location))
			<p><x-entypo-location-pin :alt="__('Lokalita')" class="inline align-text-bottom !h-5" />{{ $user->location }}</p>
		@endif
	</div>
</section>
