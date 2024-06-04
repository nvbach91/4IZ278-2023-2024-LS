<script lang="ts">
	import Button from '$components/ui/button/button.svelte';
	import * as Card from '$components/ui/card';
	import * as Dialog from '$components/ui/dialog';
	import Input from '$components/ui/input/input.svelte';
	import Label from '$components/ui/label/label.svelte';
	import type { Account, ApiKey, Sequence } from '$types/user';
	import FormBuilder from '$components/app/FormBuilder.svelte';
	import FormItem from '$components/app/FormItem.svelte';
	import { updateAccount } from '$lib/api/accounts';
	import * as Select from '$components/ui/select';
	import Separator from '$components/ui/separator/separator.svelte';
	import { X } from 'lucide-svelte';
	import { createApiKey, deleteApiKey } from '$lib/api/apiKeys';

	export let account: Account;
	export let sequences: Sequence[];
	export let apiKeys: ApiKey[];

	let name = account.name;
	let sequence: unknown = account.sequence;
	let number = account.number;
	let editOpen = false;
	let editMessage: string | undefined;

	let newApiKey = '';
</script>

<Dialog.Root bind:open={editOpen}>
	<Dialog.Trigger>
		<Card.Root class="transition-all hover:border-zinc-500">
			<Card.Header>
				<Card.Title class="text-left">{account.name}</Card.Title>
			</Card.Header>
			<Card.Content>
				<p class="text-left"><code>{account.number}</code></p>
			</Card.Content>
		</Card.Root>
	</Dialog.Trigger>

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
				<Label for="number">Account Number</Label>
				<Input type="text" id="number" name="number" bind:value={number} />
			</FormItem>
			<FormItem>
				<Label for="sequence" class="flex items-center gap-2">Sequence</Label>
				<Select.Root
					onSelectedChange={(v) => {
						v && (sequence = v.value);
					}}
					selected={{
						value: sequence,
						label: sequences.find((s) => s.id == sequence)?.generator ?? 'None'
					}}
				>
					<Select.Trigger name="account" id="account">
						<Select.Value placeholder="Sequence" />
					</Select.Trigger>
					<Select.Content>
						<Select.Item value={undefined}>None</Select.Item>
						{#each sequences as sequence}
							<Select.Item value={sequence.id}>{sequence.generator}</Select.Item>
						{/each}
					</Select.Content>
				</Select.Root>
			</FormItem>
			<Button
				variant="outline"
				on:click={async () => {
					try {
						await updateAccount(account.id, {
							name,
							number,
							sequence: sequences.find((s) => s.id == sequence)?.id ?? null
						});
						editOpen = false;
						editMessage = undefined;
					} catch (e) {
						if (e instanceof Error) editMessage = e.message;
					}
				}}>Save</Button
			>
		</FormBuilder>
		<Separator />
		<h2 class="text-lg font-semibold">API Keys</h2>
		{#each apiKeys as apiKey}
			<div class="flex gap-2">
				<Input type="text" value={apiKey.key} readonly />
				<button
					class="grid h-9 w-9 cursor-pointer place-items-center rounded-md border hover:border-zinc-500"
					on:click={() => {
						try {
							deleteApiKey(apiKey.id.toString());
							apiKeys = apiKeys.filter((k) => k.id !== apiKey.id);
						} catch (e) {
							if (e instanceof Error) editMessage = e.message;
						}
					}}
				>
					<X />
				</button>
			</div>
		{/each}
		{#if apiKeys.length >= 15}
			<p class="text-red-500">You have reached the maximum number of API keys</p>
		{:else}
			<div class="flex gap-2">
				<Input type="text" placeholder="Add new API key" bind:value={newApiKey} />
				<Button
					variant="outline"
					on:click={async () => {
						try {
							const result = await createApiKey({
								key: newApiKey,
								account_id: account.id
							});
							apiKeys = [...apiKeys, result];
							newApiKey = '';
						} catch (e) {
							if (e instanceof Error) editMessage = e.message;
						}
					}}>Add</Button
				>
			</div>
		{/if}
	</Dialog.Content>
</Dialog.Root>
