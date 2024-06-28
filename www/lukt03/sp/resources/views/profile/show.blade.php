<x-app-layout>
	<x-slot:title>{{ $user->name }}</x-slot>

    <x-slot:header>
        <x-link :href="url()->previous()">
			<x-entypo-chevron-left class="inline align-text-bottom !h-5" />{{ __('Zpět') }}
		</x-link>
    </x-slot>

	<div class="py-12">
		<div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
			@if (auth()->user()->isAdmin())
				<div class="flex justify-end gap-5">
					<form method="post">
						@csrf
						@method('get')

						<x-primary-button formaction="{{ route('profily.edit', ['user' => $user]) }}">
							{{ __('Upravit účet') }}
						</x-primary-button>
					</form>

					<x-danger-button
						x-data=""
						x-on:click.prevent="$dispatch('open-modal', {
							name: 'confirm-user-deletion',
							title: '{{ __('Opravdu chcete smazat účet :email?', ['email' => $user->email]) }}',
							action: '{{ route('profily.destroy', ['user' => $user]) }}',
						})"
					>{{ __('Smazat účet') }}</x-danger-button>
				</div>

				<x-modal name="confirm-user-deletion" focusable>
					<form method="post" x-bind:action="action" class="p-6">
						@csrf
						@method('delete')

						<h2 class="text-lg font-medium text-gray-900" x-text="title"></h2>

						<div class="mt-6 flex justify-end">
							<x-secondary-button x-on:click="$dispatch('close')">
								{{ __('Zpět') }}
							</x-secondary-button>

							<x-danger-button class="ms-3">
								{{ __('Smazat účet') }}
							</x-danger-button>
						</div>
					</form>
				</x-modal>
			@endif

			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				@include('profile.partials.profile-information')
			</div>

			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				@include('profile.partials.sitting-availability')
				<section class="mt-4" id="requestSection" hidden>
					<header>
						<h2 class="text-lg font-medium text-gray-900">
							{{ __('Žádost o hlídání') }}
						</h2>
					</header>
					<form method="post" action="{{ route('hlidani.store') }}">
						@csrf
						@method('post')
						<p>{{ __('Od:') }} <span id="requestFrom"></p>
						<p>{{ __('Do:') }} <span id="requestTo"></p>
						<input type="hidden" id="availabilityId" name="availabilityId" value="">
						<x-primary-button class="mt-1">{{ __('Požádat o hlídání') }}</x-primary-button>
					</form>
				</section>
			</div>

			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				@include('profile.partials.reviews')
			</div>

			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				@include('profile.partials.cats')
			</div>
		</div>
	</div>

	@push('scripts')
		<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/cs.js"></script>
		<script> 
            document.addEventListener("DOMContentLoaded", () => {
                var calendarEl = document.getElementById("calendar");
                var calendar = new FullCalendar.Calendar(calendarEl, {
					locale: "{{ config('app.locale') }}",
                    initialView: "timeGridWeek",
					nowIndicator: true,
					allDaySlot: false,
					scrollTime: "9:00",
					validRange: () => ({ start: new Date() }),
					events: @json($user->availableTimes),
					eventMouseEnter: () => document.body.style.cursor = "pointer",
					eventMouseLeave: () => document.body.style.cursor = "default",
					eventClick: (info) => {
						document.getElementById("availabilityId").value = info.event.id;
						document.getElementById("requestFrom").innerText = info.event.start.toLocaleString('cs');
						document.getElementById("requestTo").innerText = info.event.end.toLocaleString('cs');
						document.getElementById("requestSection").removeAttribute("hidden"); 
					}
                });
                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
