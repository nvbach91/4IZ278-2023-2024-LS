<script lang="ts">
	import type { Generated } from '$types/user';
	import { onMount } from 'svelte';
	import type { PageData } from './$types';
	import { getSingleGenerated } from '$lib/api/generated';
	import PaidBadge from '$components/app/PaidBadge.svelte';
	import { ChevronLeft } from 'lucide-svelte';

	export let data: PageData;

	let payment: Generated | null = null;
	let loadingPayment = true;

	onMount(async () => {
		payment = await getSingleGenerated(data.payment, data.hash);
		loadingPayment = false;
	});
</script>

<nav class="grid h-16 w-full grid-cols-[4rem,_1fr,_4rem] items-center border-b">
	<a href="/app/seller/{data.hash}" class="grid h-16 w-16 place-items-center">
		<ChevronLeft />
	</a>
	<h2 class="text-center text-lg">Payment</h2>
</nav>
<div class="container mt-4">
	{#if loadingPayment}
		Loading...
	{:else if !payment}
		<p>Oops, something went wrong!</p>
	{:else}
		<h1 class="mt-2 text-3xl font-bold">{payment.amount} CZK</h1>
		<div class="mt-2">
			<PaidBadge paid={payment.success} />
		</div>
		<p class="mt-2">Variable symbol: {payment.variable_symbol}</p>
	{/if}
</div>
