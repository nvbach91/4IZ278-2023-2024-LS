<script lang="ts">
	import Client from '$components/app/Client.svelte';
	import UserInfo from '$components/app/UserInfo.svelte';
	import { getClients } from '$lib/api/clients';
	import type { Client as ClientType } from '$types/user';
	import { onMount } from 'svelte';
	import Adder from '$components/app/Adder.svelte';

	let clients: ClientType[] | null = [];
	let loadingClients = true;

	onMount(async () => {
		clients = await getClients();
		loadingClients = false;
	});
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
			<Adder />
		</div>
	{/if}
</div>
