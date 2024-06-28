<tr class="border-b">
	<td class="p-1">
		<img src="{{ asset($user->avatarUrlWithPlaceholder) }}" :alt="__('Avatar profilu')" class="min-w-16 w-16 h-16 rounded-lg object-contain">
	</td>
	<td class="p-4">
		<x-link :href="route('profily.show', ['user' => $user])">
			{{ $user->name }}
		</x-link>
	</td>
	<td class="p-4">
		@if (($sitting->status == 0 && $sitting->sitter->id === auth()->user()->id) || $sitting->status == 1)
			{{ $user->email }}
		@endif
	</td>
	<td class="p-4">
		{{ $sitting->start->isoFormat('LLLL') }}
	</td>
	<td class="p-4">
		{{ $sitting->end->isoFormat('LLLL') }}
	</td>
	<td class="p-4">
		@if ($sitting->status === 0)
			<x-entypo-hour-glass alt="{{ __('Čeká na schválení') }}" />
		@elseif ($sitting->status === 1)
			<x-entypo-check alt="{{ __('Potvrzeno') }}" />
		@elseif ($sitting->status === 2)
			<x-entypo-cross alt="{{ __('Zrušeno') }}" />
		@endif
	</td>
	<td class="text-center">
		<div class="p-2 pt-0.5">
			@if ($sitting->sitter->id === auth()->user()->id && $sitting->status === 0 && $sitting->start->isBefore(now()))
				<x-primary-button form="confirm-sitting" formaction="{{ route('hlidani.update', ['sitting' => $sitting]) }}">
					{{ __('Potvrdit') }}
				</x-primary-button>
			@endif
			@if (($sitting->status == 0 && $sitting->start->isBefore(now())) || (sitting->status == 1 && $sitting->start->diffInHours(now()) > 24))
				<x-danger-button
					x-data=""
					x-on:click.prevent="$dispatch('open-modal', {
						name: 'confirm-sitting-deletion',
						title: '{{ __('Opravdu chcete zrušit termín hlídání?') }}',
						action: '{{ route('hlidani.destroy', ['sitting' => $sitting]) }}',
					})"
				>{{ __('Zrušit') }}</x-danger-button>
			@endif
		</div>
	</td>
</tr>
