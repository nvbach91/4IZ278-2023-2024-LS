<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Moje kočky') }}
        </h2>
    </header>

    <div class="space-y-1">
        @forelse ($user->cats as $cat)
            <div class="p-4 sm:p-8">
                @include('cat.partials.cat-card')
            </div>
        @empty
            <div class="text-center">{{ __('Zatím žádné nemám.') }}</div>
        @endforelse
    </div>
</section>
