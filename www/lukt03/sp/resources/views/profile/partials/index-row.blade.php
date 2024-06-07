<tr class="border-b">
	<td class="p-1">
		<img src="{{ asset($user->avatar_url_with_placeholder) }}" class="min-w-16 w-16 h-16 rounded-lg object-contain">
	</td>
	<td class="p-4">
		<x-link :href="route('profily.show', ['user' => $user->id])">
			{{ $user->name }}
		</x-link>
	</td>
	<td class="p-4">
		{{ $user->email }}
	</td>
	<td class="p-4">
		{{ $user->location }}
	</td>
	<td class="p-4 text-center">
		{{ $user->cats()->count() }}
	</td>
	<td class="p-4">
		@if (!$user->hasVerifiedEmail())
			<x-entypo-cross class="fill-red-700 m-auto" />
		@endif
	</td>
	<td class="p-4">
		@if ($user->isSitter())
			<x-entypo-check class="fill-teal-600 m-auto" />
		@endif
	</td>
	<td class="text-center">
		@if ($user->id !== auth()->user()->id)
			<div class="p-2 pb-0.5">
				<x-primary-button form="edit-profile" formaction="{{ route('profily.edit', ['user' => $user]) }}">
					{{ __('Upravit účet') }}
				</x-primary-button>
			</div>

			<div class="p-2 pt-0.5">
				<x-danger-button
					x-data=""
					x-on:click.prevent="$dispatch('open-modal', {
						name: 'confirm-user-deletion',
						title: '{{ __('Opravdu chcete smazat účet :email?', ['email' => $user->email]) }}',
						action: '{{ route('profily.destroy', ['user' => $user]) }}',
					})"
				>{{ __('Smazat účet') }}</x-danger-button>
			</div>
		@endif
	</td>
</tr>
