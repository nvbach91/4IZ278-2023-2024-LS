<tr class="border-b">
	<td class="p-1">
		<img src="{{ asset($sitting->owner->avatarUrlWithPlaceholder) }}" :alt="__('Avatar vlastníka')" class="min-w-16 w-16 h-16 rounded-lg object-contain">
	</td>
	<td class="p-4">
		<x-link :href="route('profily.show', ['user' => $sitting->owner])">
			{{ $sitting->owner->name }}
		</x-link>
	</td>
	<td class="p-1">
		<img src="{{ asset($sitting->sitter->avatarUrlWithPlaceholder) }}" :alt="__('Avatar hlídače')" class="min-w-16 w-16 h-16 rounded-lg object-contain">
	</td>
	<td class="p-4">
		<x-link :href="route('profily.show', ['user' => $sitting->sitter])">
			{{ $sitting->sitter->name }}
		</x-link>
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
</tr>
