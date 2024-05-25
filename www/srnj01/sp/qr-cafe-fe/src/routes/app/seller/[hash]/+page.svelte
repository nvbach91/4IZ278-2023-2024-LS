<script lang="ts">
	import { onMount } from 'svelte';
	import type { PageData } from './$types';
	import type { Seller as SellerType } from '$types/user';
	import { getSellerByHash } from '$lib/api/sellers';

	export let data: PageData;

	const hash = data.hash;

	let seller: SellerType | null = null;

	onMount(async () => {
		seller = await getSellerByHash(hash);
	});
</script>

<div class="container mt-8">
	{#if !seller}
		<p>Loading seller...</p>
	{:else}
		<h2 class="text-2xl font-bold">{seller.name}</h2>
		<p>Active: {seller.active ? 'Yes' : 'No'}</p>
	{/if}
</div>
