<script lang="ts">
	import type { Generated } from '$types/user';
	import { onMount } from 'svelte';
	import type { PageData } from './$types';
	import { getSingleGenerated } from '$lib/api/generated';
	import PaidBadge from '$components/app/PaidBadge.svelte';
	import { ChevronLeft } from 'lucide-svelte';
	import * as Dialog from '$components/ui/dialog';
	import { goto } from '$app/navigation';
	import Button from '$components/ui/button/button.svelte';

	export let data: PageData;

	let payment: Generated | null = null;
	let loadingPayment = true;

	let paid = false;

	let redirect: number | null;

	onMount(async () => {
		payment = await getSingleGenerated(data.payment, data.hash);
		loadingPayment = false;
		if (!payment?.success) {
			const interval = setInterval(async () => {
				payment = await getSingleGenerated(data.payment, data.hash);
				if (payment?.success) {
					clearInterval(interval);
					paid = true;
					redirect = setTimeout(() => {
						goto(`/app/seller/${data.hash}`);
					}, 5000);
				}
			}, 2000);
		}
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
	<Dialog.Root
		bind:open={paid}
		onOpenChange={() => {
			if (redirect) {
				clearTimeout(redirect);
			}
		}}
	>
		<Dialog.Content class="max-w-[90vw] rounded-lg" noCloseButton>
			<PaidBadge paid />
			<p>You will be redirected in a moment...</p>
			<p>If you wish to stay on this page, you can close this dialog.</p>
			<div class="grid grid-cols-2 gap-2">
				<Button
					variant="outline"
					on:click={() => {
						paid = false;
					}}>Close</Button
				>
				<Button href="/app/seller/{data.hash}">Redirect now</Button>
			</div>
		</Dialog.Content>
	</Dialog.Root>
</div>
