<script lang="ts">
	import * as Card from '$components/ui/card';
	import type { Client } from '$types/user';
	import ActiveBadge from '$components/app/ActiveBadge.svelte';
	export let client: Client;
</script>

<a href="/app/client/{client.id}" class="min-w-64 max-w-96">
	<Card.Root class="transition-all hover:border-zinc-500">
		<Card.Header>
			<Card.Title>{client.name}</Card.Title>
			<Card.Description>
				<ActiveBadge active={client.active} />
			</Card.Description>
		</Card.Header>
		<Card.Content>
			<p>Current Fee: {client.fee}%</p>
		</Card.Content>
	</Card.Root>
</a>
