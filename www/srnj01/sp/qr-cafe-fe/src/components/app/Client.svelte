<script lang="ts">
	import Badge from '$components/ui/badge/badge.svelte';
	import * as Card from '$components/ui/card';
	import type { Client } from '$types/user';
	export let client: Client;
</script>

<a href="/app/client/{client.id}" class="min-w-64 max-w-96">
	<Card.Root class="transition-all hover:border-zinc-500">
		<Card.Header>
			<Card.Title>{client.name}</Card.Title>
			<Card.Description>
				{#if client.active}
					<Badge class="bg-lime-600">Active</Badge>
				{:else}
					<Badge class="bg-red-800">Inactive</Badge>
				{/if}
			</Card.Description>
		</Card.Header>
		<Card.Content>
			<p>Current Fee: {client.fee}%</p>
		</Card.Content>
	</Card.Root>
</a>
