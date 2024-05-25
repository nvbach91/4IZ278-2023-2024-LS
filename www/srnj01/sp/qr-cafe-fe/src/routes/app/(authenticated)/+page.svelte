<script lang="ts">
	import Client from '$components/app/Client.svelte';
	import UserInfo from '$components/app/UserInfo.svelte';
	import { createClient, getClients } from '$lib/api/clients';
	import type { Client as ClientType } from '$types/user';
	import { onMount } from 'svelte';
	import Adder from '$components/app/Adder.svelte';
	import * as Dialog from '$components/ui/dialog';
	import * as Tooltip from '$components/ui/tooltip';
	import FormBuilder from '$components/app/FormBuilder.svelte';
	import FormItem from '$components/app/FormItem.svelte';
	import Label from '$components/ui/label/label.svelte';
	import Input from '$components/ui/input/input.svelte';
	import Checkbox from '$components/ui/checkbox/checkbox.svelte';
	import Button from '$components/ui/button/button.svelte';
	import { CircleHelp } from 'lucide-svelte';
	import { user } from '$lib';

	let clients: ClientType[] | null = [];
	let loadingClients = true;

	onMount(async () => {
		clients = await getClients();
		loadingClients = false;
	});

	let newName = '';
	let newActive = true;
	let newFee = 2;

	let createOpen = false;
	let createMessage: string | undefined = undefined;
</script>

<div class="container mt-4">
	<UserInfo />
	{#if loadingClients}
		<p>Loading clients...</p>
	{:else if !clients || clients.length === 0}
		<p>No clients found</p>
	{:else}
		<h2 class="mt-4 text-2xl font-bold">Clients</h2>
		<div class="mt-4 grid max-w-full grid-cols-[repeat(auto-fill,_minmax(256px,_1fr))] gap-4">
			{#each clients as client}
				<Client {client} />
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
								bind:value={newFee}
								disabled={$user?.role !== 'admin'}
							/>
						</FormItem>
						<FormItem row>
							<Checkbox bind:checked={newActive} id="active">Active</Checkbox>
							<Label for="active" class="cursor-pointer">Active</Label>
						</FormItem>
						<Button
							on:click={async () => {
								try {
									await createClient({
										name: newName,
										active: newActive,
										fee: $user?.role === 'admin' ? newFee : null
									});
									clients = await getClients();
									createOpen = false;
									newName = '';
									newActive = true;
									newFee = 2;
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
</div>
