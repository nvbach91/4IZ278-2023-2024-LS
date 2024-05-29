<script lang="ts">
	import { onMount } from 'svelte';
	import type { PageData } from './$types';
	import type { Seller as SellerType, Account as AccountType } from '$types/user';
	import { getSellerByHash } from '$lib/api/sellers';
	import FormBuilder from '$components/app/FormBuilder.svelte';
	import FormItem from '$components/app/FormItem.svelte';
	import Label from '$components/ui/label/label.svelte';
	import Input from '$components/ui/input/input.svelte';
	import Separator from '$components/ui/separator/separator.svelte';
	import Button from '$components/ui/button/button.svelte';
	import { createGenerated } from '$lib/api/generated';
	import { goto } from '$app/navigation';
	import { getAccounts } from '$lib/api/accounts';
	import * as Select from '$components/ui/select';
	import { generateNext } from '$lib/api/sequences';
	import { toast } from 'svelte-sonner';

	export let data: PageData;

	const hash = data.hash;

	let seller: SellerType | null = null;
	let accounts: AccountType[] | null = null;

	onMount(async () => {
		seller = await getSellerByHash(hash);
		accounts = await getAccounts(hash);
	});

	let amount = 100;
	let variable_symbol = '';

	let account: unknown = null;
</script>

<div class="container mt-8">
	{#if !seller}
		<p>Loading seller...</p>
	{:else}
		<h2 class="text-2xl font-bold">{seller.name}</h2>
		<Separator class="mb-4 mt-4" />
		{#if seller.active && accounts}
			<h3 class=" text-lg font-bold">New payment</h3>
			<FormBuilder>
				<FormItem>
					<Label for="amount">Amount in CZK</Label>
					<Input type="number" id="amount" name="amount" bind:value={amount} />
				</FormItem>
				<FormItem>
					<Label for="account">Account</Label>
					<Select.Root
						onSelectedChange={(v) => {
							v && (account = v.value);
						}}
					>
						<Select.Trigger name="account" id="account">
							<Select.Value placeholder="Account" />
						</Select.Trigger>
						<Select.Content>
							{#each accounts as account}
								<Select.Item value={account.id}>{account.name}</Select.Item>
							{/each}
						</Select.Content>
					</Select.Root>
				</FormItem>
				<FormItem>
					<Label for="variable_symbol">Variable symbol</Label>
					<Input
						type="text"
						id="variable_symbol"
						name="variable_symbol"
						disabled={accounts.find((a) => a.id == account)?.sequence ? true : false}
						placeholder={accounts.find((a) => a.id == account)?.sequence
							? 'Will be generated automatically.'
							: 'Variable symbol'}
						bind:value={variable_symbol}
					/>
				</FormItem>
				<Button
					variant="outline"
					on:click={async () => {
						if (!seller) return;
						try {
							if (!amount) {
								toast('Please enter an amount.');
								return;
							}
							if (!accounts || !accounts.find((a) => a.id == account)) {
								toast('Please select an account.');
								return;
							}
							if (accounts.find((a) => a.id == account)?.sequence) {
								const result = await generateNext(
									`${accounts.find((a) => a.id == account)?.sequence}`,
									hash
								);
								variable_symbol = result.last_used;
							}
							if (!variable_symbol) {
								toast('Please enter a variable symbol.');
								return;
							}
							const result = await createGenerated(
								{
									amount,
									variable_symbol,
									seller_id: seller.id,
									account_id: accounts.find((a) => a.id == account)?.id ?? 0,
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
