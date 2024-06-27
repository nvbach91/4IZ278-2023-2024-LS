<section id="reviews">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Hodnocení') }}
        </h2>
        {{ $reviews->onEachSide(1)->links() }}
    </header>

	<div class="space-y-1">
        @forelse ($reviews as $review)
            <div class="p-4">
                
            </div>
        @empty
            <div class="text-center">{{ __('Zatím žádné nemám.') }}</div>
        @endforelse
    </div>
</section>
