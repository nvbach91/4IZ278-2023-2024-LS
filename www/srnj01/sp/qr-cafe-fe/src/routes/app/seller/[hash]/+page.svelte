<script lang="ts">
	import { onMount } from 'svelte';
	import type { PageData } from './$types';
	import type { Seller as SellerType } from '$types/user';
	import { getSellerByHash } from '$lib/api/sellers';
	import FormBuilder from '$components/app/FormBuilder.svelte';
	import FormItem from '$components/app/FormItem.svelte';
	import Label from '$components/ui/label/label.svelte';
	import Input from '$components/ui/input/input.svelte';
	import Separator from '$components/ui/separator/separator.svelte';
	import Button from '$components/ui/button/button.svelte';
	import { createGenerated } from '$lib/api/generated';
	import { goto } from '$app/navigation';

	export let data: PageData;

	const hash = data.hash;

	let seller: SellerType | null = null;

	onMount(async () => {
		seller = await getSellerByHash(hash);
	});

	let amount = 100;
</script>

<div class="container mt-8">
	{#if !seller}
		<p>Loading seller...</p>
	{:else}
		<h2 class="text-2xl font-bold">{seller.name}</h2>
		<Separator class="mb-4 mt-4" />
		{#if seller.active}
			<h3 class=" text-lg font-bold">New payment</h3>
			<FormBuilder>
				<FormItem>
					<Label for="amount">Amount in CZK</Label>
					<Input type="number" id="amount" name="amount" bind:value={amount} />
				</FormItem>
				<Button
					variant="outline"
					on:click={async () => {
						if (!seller) return;
						try {
							const result = await createGenerated(
								{
									amount,
									variable_symbol: 'foo',
									seller_id: seller.id,
									account_id: 3,
									success: false
								},
								hash
							);
							goto(`/app/seller/${data.hash}/${result.id}`);
						} catch (e) {
							console.error(e);
						}
					}}
				>
					Create payment
				</Button>
			</FormBuilder>
			<Separator class="mb-4 mt-4" />
			<Button variant="outline" href="/app/seller/{data.hash}/payments">Open past payments</Button>
		{:else}
			<p>This seller is inactive. Please contact the owner to activate this account.</p>
		{/if}
	{/if}
</div>
