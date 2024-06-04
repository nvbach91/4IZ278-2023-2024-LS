<script lang="ts">
	import { getGenerated } from '$lib/api/generated';
	import type { Generated } from '$types/user';
	import { onMount } from 'svelte';
	import type { PageData } from './$types';
	import ActiveBadge from '$components/app/ActiveBadge.svelte';
	import { ChevronLeft } from 'lucide-svelte';

	export let data: PageData;

	let payments: Generated[] | null = [];
	let loadingPayments = true;

	onMount(async () => {
		payments =
			(await getGenerated(data.hash))?.sort(
				(a, b) => new Date(b.created_at ?? '').getTime() - new Date(a.created_at ?? '').getTime()
			) ?? [];
		loadingPayments = false;
	});
</script>

<nav class="grid h-16 w-full grid-cols-[4rem,_1fr,_4rem] items-center border-b">
	<a href="/app/seller/{data.hash}" class="grid h-16 w-16 place-items-center">
		<ChevronLeft />
	</a>
	<h2 class="text-center text-lg">Payments</h2>
</nav>
<div class="container mt-4">
	{#if loadingPayments}
		<p>Loading payments...</p>
	{:else if !payments}
		<p>Oops, something went wrong!</p>
	{:else}
		<div class="mt-4 grid max-w-full grid-cols-[repeat(auto-fill,_minmax(256px,_1fr))] gap-4">
			{#each payments as payment}
				<a
					class="h-full min-w-64 max-w-96 rounded-md border"
					href="/app/seller/{data.hash}/{payment.id}"
				>
					<div class="h-full transition-all hover:border-zinc-500">
						<div class="p-4">
							<p class="text-lg font-bold">{payment.amount.toFixed(2)} CZK</p>
							<ActiveBadge
								active={payment.success}
								activeText="Success"
								inactiveText="Not Verified"
							/>
							{#if payment.created_at}
								<p class="mt-2 text-sm">
									{new Date(payment.created_at).toLocaleDateString('cs-CZ', {
										year: 'numeric',
										month: 'long',
										day: 'numeric'
									})}
									{new Date(payment.created_at).toLocaleTimeString('cs-CZ')}
								</p>
							{/if}
						</div>
					</div>
				</a>
			{/each}
		</div>
	{/if}
</div>
