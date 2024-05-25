<script lang="ts">
	import * as Breadcrumb from '$components/ui/breadcrumb';
	import type { PageData } from './$types';
	import type { Client as ClientType, Seller as SellerType } from '$types/user';
	import { onMount } from 'svelte';
	import { getClient } from '$lib/api/clients';
	import { getSeller, updateSeller } from '$lib/api/sellers';
	import ActiveBadge from '$components/app/ActiveBadge.svelte';
	import { Button } from '$components/ui/button/';
	import * as Dialog from '$components/ui/dialog';
	import FormBuilder from '$components/app/FormBuilder.svelte';
	import FormItem from '$components/app/FormItem.svelte';
	import Label from '$components/ui/label/label.svelte';
	import Input from '$components/ui/input/input.svelte';

	export let data: PageData;

	let client: ClientType | null = null;
	let loadingClient = true;

	let seller: SellerType | null = null;
	let loadingSeller = true;

	let name = '';
	let active = false;

	onMount(async () => {
		client = await getClient(data.id);
		loadingClient = false;
		seller = await getSeller(data.seller);
		loadingSeller = false;
		if (seller) {
			name = seller.name;
			active = seller.active;
		}
	});

	let editMessage: string | undefined = undefined;
	let editOpen = false;
</script>

<div class="container mt-4">
	{#if loadingClient || loadingSeller}
		Loading...
	{:else if client && seller}
		<Dialog.Root bind:open={editOpen}>
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
			<Button
				variant="outline"
				class="mt-2"
				on:click={() => {
					editOpen = true;
				}}>Edit</Button
			>
			<div class="mt-8 flex items-center gap-3">
				<h2 class=" text-lg font-bold">{client.name}</h2>
				<ActiveBadge active={client.active} />
			</div>
			<p>Current Fee: {client.fee}%</p>

			<Dialog.Content>
				<Dialog.Header>
					<Dialog.Title>Edit client</Dialog.Title>
					<Dialog.Description>Edit the client's details</Dialog.Description>
				</Dialog.Header>
				<FormBuilder message={editMessage}>
					<FormItem>
						<Label for="name">Name</Label>
						<Input type="text" id="name" name="name" bind:value={name} />
					</FormItem>
					<Button
						variant="outline"
						class="mt-2 {active ? 'bg-lime-600' : 'bg-red-800'} text-white"
						on:click={() => (active = !active)}
					>
						{active ? 'Activated' : 'Deactivated'}
					</Button>
					<Button
						variant="outline"
						on:click={async () => {
							try {
								await updateSeller(data.id, {
									name,
									active
								});
								seller = await getSeller(data.id);
								editOpen = false;
								editMessage = undefined;
							} catch (e) {
								if (e instanceof Error) editMessage = e.message;
							}
						}}>Save</Button
					>
				</FormBuilder>
			</Dialog.Content>
		</Dialog.Root>
	{/if}
</div>
