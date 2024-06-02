@props(['type' => 'info'])

@php
	$success = $type === 'success';
	$warning = $type === 'warning';
	$danger = $type === 'danger';
	$info = !($success | $warning | $danger);
@endphp

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
	<div {{ $attributes
		->class([
			'border-t-4 rounded-b-lg px-6 py-3 shadow-md',
			'bg-teal-100 border-teal-500 text-teal-900' => $success,
			'bg-orange-100 border-orange-500 text-orange-900' => $warning,
			'bg-red-100 border-red-500 text-red-900' => $danger,
			'bg-blue-100 border-blue-500 text-blue-900' => $info,
		])
		->merge(['role' => 'alert'])
	}}>
		<div class="flex">
			<div class="py-2 mr-4">
				@if ($success)
					<x-entypo-check />
				@elseif ($warning)
					<x-entypo-warning />
				@elseif ($danger)
					<x-entypo-circle-with-cross />
				@else
					<x-entypo-info />
				@endif
			</div>
			<div>
				{{ $slot }}
			</div>
		</div>
	</div>
</div>
