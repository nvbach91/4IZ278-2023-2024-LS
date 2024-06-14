<tr class="border-b">
	<td class="p-1">
		<img src="{{ asset($cat->photo_url_with_placeholder) }}" class="min-w-16 w-16 h-16 rounded-lg object-contain">
	</td>
	<td class="p-4">
		{{ $cat->name }}
	</td>
	<td class="p-4">
		<x-link :href="route('profily.show', ['user' => $cat->owner->id])">
			{{ $cat->owner->name }}
		</x-link>
	</td>
	<td class="p-4">
		{{ $cat->details }}
	</td>
	<td class="text-center">
		<div class="p-2 pb-0.5">
			<x-secondary-button form="edit-cat" formaction="{{ route('kocky.edit', ['cat' => $cat]) }}">
				{{ __('Upravit') }}
			</x-secondary-button>
		</div>

		<div class="p-2 pt-0.5">
			<x-danger-button
				x-data=""
				x-on:click.prevent="$dispatch('open-modal', {
					name: 'confirm-cat-deletion',
					title: '{{ __('Opravdu chcete smazat kočku :catName uživatele :userName?', [
						'catName' => $cat->name,
						'userName' => $cat->owner->name
					]) }}',
					action: '{{ route('kocky.destroy', ['cat' => $cat]) }}',
				})"
			>{{ __('Smazat') }}</x-danger-button>
		</div>
	</td>
</tr>
