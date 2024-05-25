<script lang="ts">
	import * as Breadcrumb from '$components/ui/breadcrumb';
	import type { PageData } from './$types';
	import type { Client as ClientType, Seller as SellerType } from '$types/user';
	import { onMount } from 'svelte';
	import { getClient } from '$lib/api/clients';
	import { getSeller } from '$lib/api/sellers';
	import ActiveBadge from '$components/app/ActiveBadge.svelte';
	import { Button } from '$components/ui/button/';

	export let data: PageData;

	let client: ClientType | null = null;
	let loadingClient = true;

	let seller: SellerType | null = null;
	let loadingSeller = true;

	onMount(async () => {
		client = await getClient(data.id);
		loadingClient = false;
		seller = await getSeller(data.seller);
		loadingSeller = false;
	});
</script>

<div class="container mt-4">
	{#if loadingClient || loadingSeller}
		Loading...
	{:else if client && seller}
		<Breadcrumb.Root>
			<Breadcrumb.List>
				<Breadcrumb.Item>
					<Breadcrumb.Link href="/app">Home</Breadcrumb.Link>
				</Breadcrumb.Item>
				<Breadcrumb.Separator />
				<Breadcrumb.Item>
					<Breadcrumb.Link href="/app/client/{data.id}">{client?.name ?? ''}</Breadcrumb.Link>
				</Breadcrumb.Item>
				<Breadcrumb.Separator />
				<Breadcrumb.Item>
					<Breadcrumb.Page>{data.id}</Breadcrumb.Page>
				</Breadcrumb.Item>
			</Breadcrumb.List>
		</Breadcrumb.Root>
		<div class="mt-4 flex items-center gap-4">
			<h2 class="text-2xl font-bold">
				{seller.name}
			</h2>
			<ActiveBadge active={seller.active} />
		</div>
		<Button
			variant="outline"
			href="/app/seller/{seller.hash}"
			target="_blank"
			class="mt-2 block w-fit">Go to seller page</Button
		>
		<Button variant="outline" class="mt-2 block w-fit"
			>{seller.active ? 'Deactivate' : 'Activate'}</Button
		>
		<div class="mt-8 flex items-center gap-3">
			<h2 class=" text-lg font-bold">{client.name}</h2>
			<ActiveBadge active={client.active} />
		</div>
		<p>Current Fee: {client.fee}%</p>
	{/if}
</div>
