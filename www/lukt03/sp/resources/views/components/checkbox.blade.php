@props(['checked' => false, 'disabled' => false])

<label for="{{ $attributes->get('id') }}" class="inline-flex items-center">
	<input type="checkbox" {{ $checked ? 'checked' : '' }} {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500']) }}>
	<span class="ms-2 text-sm text-gray-700">{{ $slot }}</span>
</label>
