<script lang="ts">
	import FormBuilder from '$components/app/FormBuilder.svelte';
	import FormItem from '$components/app/FormItem.svelte';
	import { onMount } from 'svelte';
	import { deleteClient, getClient, updateClient } from '$lib/api/clients';
	import type { Client as ClientType, Seller as SellerType } from '$types/user';
	import type { PageData } from './$types';
	import { createSeller, getSellers } from '$lib/api/sellers';
	import Seller from '$components/app/Seller.svelte';
	import Adder from '$components/app/Adder.svelte';
	import * as Breadcrumb from '$components/ui/breadcrumb';
	import * as Dialog from '$components/ui/dialog';
	import * as Tooltip from '$components/ui/tooltip';
	import ActiveBadge from '$components/app/ActiveBadge.svelte';
	import { Button } from '$components/ui/button';
	import Label from '$components/ui/label/label.svelte';
	import Input from '$components/ui/input/input.svelte';
	import { user } from '$lib';
	import { CircleHelp } from 'lucide-svelte';
	import Checkbox from '$components/ui/checkbox/checkbox.svelte';
	import { createHash } from '$lib/api';
	import { goto } from '$app/navigation';
	import { Description } from '$components/ui/card';

	export let data: PageData;

	let client: ClientType | null = null;
	let loadingClient = true;

	let sellers: SellerType[] | null = [];
	let loadingSellers = true;

	let name = '';
	let fee = 0;
	let active = false;

	let newName = '';
	let newActive = true;

	onMount(async () => {
		client = await getClient(data.id);
		loadingClient = false;
		if (client) {
			name = client.name;
			fee = client.fee;
			active = client.active;
		}
		sellers = await getSellers();
		loadingSellers = false;
	});

	let editOpen = false;
	let editMessage: string | undefined = undefined;

	let createOpen = false;
	let createMessage: string | undefined = undefined;

	let deleteOpen = false;
	let deleteMessage: string | undefined = undefined;
</script>

<div class="container mt-4">
	{#if loadingClient}
		<p>Loading client...</p>
	{:else if client}
		<Dialog.Root bind:open={editOpen}>
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
			<div class="mt-2 flex gap-2">
				<Dialog.Trigger>
					<Button variant="outline">Edit</Button>
				</Dialog.Trigger>
				<Dialog.Root>
					<Dialog.Trigger>
						<Button class="bg-red-800 text-white">Delete</Button>
					</Dialog.Trigger>
					<Dialog.Content>
						<Dialog.Header>
							<Dialog.Title>Delete client</Dialog.Title>
							<Dialog.Description
								>Are you sure you want to delete this client? This action is not reversible! If you
								wish, you can just deactivate the client using the edit form.</Dialog.Description
							>
							<Dialog.Description>
								{client.name} will be permanently deleted from the system. All sellers associated with
								this client will also be deleted with all their data.
							</Dialog.Description>
							{#if deleteMessage}
								<Dialog.Description class="text-red-800">{deleteMessage}</Dialog.Description>
							{/if}
						</Dialog.Header>
						<FormBuilder message={deleteMessage}>
							<Button
								variant="outline"
								class="bg-red-800 text-white"
								on:click={async () => {
									try {
										await deleteClient(data.id);
										goto('/app');
									} catch (e) {
										if (e instanceof Error) deleteMessage = e.message;
									}
								}}
							>
								Delete
							</Button>
						</FormBuilder>
					</Dialog.Content>
				</Dialog.Root>
			</div>

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
					<Dialog.Root bind:open={createOpen}>
						<Dialog.Trigger>
							<Adder />
						</Dialog.Trigger>
						<Dialog.Content>
							<Dialog.Header>
								<Dialog.Title>Add seller</Dialog.Title>
								<Dialog.Description>Add a new seller to the client</Dialog.Description>
							</Dialog.Header>
							<FormBuilder message={createMessage}>
								<FormItem>
									<Label for="name">Name</Label>
									<Input type="text" id="name" name="name" bind:value={newName} />
								</FormItem>
								<FormItem row>
									<Checkbox bind:checked={newActive} id="active">Active</Checkbox>
									<Label for="active" class="cursor-pointer">Active</Label>
								</FormItem>
								<Button
									on:click={async () => {
										try {
											await createSeller({
												name: newName,
												active: newActive,
												client_id: data.id,
												hash: createHash()
											});
											sellers = await getSellers();
											createOpen = false;
											newName = '';
											active = true;
										} catch (e) {
											if (e instanceof Error) createMessage = e.message;
										}
									}}
								>
									Add
								</Button>
							</FormBuilder>
						</Dialog.Content>
					</Dialog.Root>
				</div>
			{/if}

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
					<FormItem>
						<Label for="fee" class="flex items-center gap-2">
							Fee
							<Tooltip.Root>
								<Tooltip.Trigger>
									<CircleHelp size={16} />
								</Tooltip.Trigger>
								<Tooltip.Content>
									The fee is the percentage of the total sale that the client will pay to QR Café.
									If you wish to change the fee, please contact an administrator.
								</Tooltip.Content>
							</Tooltip.Root>
						</Label>
						<Input
							type="number"
							id="fee"
							name="fee"
							bind:value={fee}
							disabled={$user?.role !== 'admin'}
						/>
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
								await updateClient(data.id, {
									name,
									fee: $user?.role === 'admin' ? fee : null,
									active
								});
								client = await getClient(data.id);
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
	{:else}
		<p>404: Not found</p>
	{/if}
</div>
