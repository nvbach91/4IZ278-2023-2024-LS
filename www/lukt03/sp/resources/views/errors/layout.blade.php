<x-app-layout>
    <x-slot:title>{{ __('http-statuses.' . $exception->getStatusCode()) }}</x-slot>

    <x-alert :type="$type ?? 'danger'">
        <p class="font-bold">
            {{ __('http-statuses.' . $exception->getStatusCode()) }}
        </p>
        <p class="text-sm">
            {{ __($exception->getMessage()) }}
        </p>
    </x-alert>
</x-app-layout>
