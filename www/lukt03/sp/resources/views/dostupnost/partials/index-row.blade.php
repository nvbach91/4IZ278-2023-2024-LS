<tr class="border-b">
	<td class="p-4 text-center">
		{{ $event->start->isoFormat('LLLL') }}
	</td>
	<td class="p-4 text-center">
		{{ $event->end->isoFormat('LLLL') }}
	</td>
	<td class="text-center">
		<div class="p-2">
			<x-primary-button form="edit-event" formaction="{{ route('dostupnost.edit', ['event' => $event]) }}">
				{{ __('Upravit') }}
			</x-primary-button>
		</div>
	</td>
	<td class="text-center">
		<div class="p-2">
			<x-danger-button
				x-data=""
				x-on:click.prevent="$dispatch('open-modal', {
					name: 'confirm-event-deletion',
					title: '{{ __('Opravdu chcete smazat událost?') }}',
					action: '{{ route('dostupnost.destroy', ['event' => $event]) }}',
				})"
			>{{ __('Smazat') }}</x-danger-button>
		</div>
	</td>
</tr>
