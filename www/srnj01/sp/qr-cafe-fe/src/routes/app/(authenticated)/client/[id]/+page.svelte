<script lang="ts">
	import { onMount } from 'svelte';
	import { getClient } from '$lib/api/clients';
	import type { Client as ClientType, Seller as SellerType } from '$types/user';
	import type { PageData } from './$types';
	import { getSellers } from '$lib/api/sellers';
	import Seller from '$components/app/Seller.svelte';
	import Adder from '$components/app/Adder.svelte';
	import * as Breadcrumb from '$components/ui/breadcrumb';
	import ActiveBadge from '$components/app/ActiveBadge.svelte';
	import { Button } from '$components/ui/button';

	export let data: PageData;

	let client: ClientType | null = null;
	let loadingClient = true;

	let sellers: SellerType[] | null = [];
	let loadingSellers = true;

	onMount(async () => {
		client = await getClient(data.id);
		loadingClient = false;
		sellers = await getSellers();
		loadingSellers = false;
	});
</script>

<div class="container mt-4">
	{#if loadingClient}
		<p>Loading client...</p>
	{:else if client}
		<Breadcrumb.Root>
			<Breadcrumb.List>
				<Breadcrumb.Item>
					<Breadcrumb.Link href="/app">Home</Breadcrumb.Link>
				</Breadcrumb.Item>
				<Breadcrumb.Separator />
				<Breadcrumb.Item>
					<Breadcrumb.Page>{client.name}</Breadcrumb.Page>
				</Breadcrumb.Item>
			</Breadcrumb.List>
		</Breadcrumb.Root>
		<div class="mt-4 flex items-center gap-4">
			<h2 class="text-2xl font-bold">{client.name}</h2>
			<ActiveBadge active={client.active} />
		</div>
		<p>Current Fee: {client.fee}%</p>
		<Button variant="outline" class="mt-2">{client.active ? 'Deactivate' : 'Activate'}</Button>

		{#if loadingSellers}
			<p>Loading sellers...</p>
		{:else if !sellers || sellers.length === 0}
			<p>No sellers found</p>
		{:else}
			<h2 class="mt-4 text-2xl font-bold">Sellers</h2>
			<div class="mt-4 grid max-w-full grid-cols-[repeat(auto-fill,_minmax(256px,_1fr))] gap-4">
				{#each sellers.filter((seller) => seller.client_id.toString() === data.id) as seller}
					<a href="/app/client/{data.id}/{seller.id}" class="min-w-64 max-w-96">
						<Seller {seller} />
					</a>
				{/each}
				<Adder />
			</div>
		{/if}
	{:else}
		<p>404: Not found</p>
	{/if}
</div>
