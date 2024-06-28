@props(['value'])

<textarea {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm disabled:text-gray-500']) }}>{{ $value ?? $slot }}</textarea>
