<script lang="ts">
	import * as Card from '$components/ui/card';
	import type { Seller as SellerType } from '$types/user';
	import { Pencil } from 'lucide-svelte';
	import ActiveBadge from './ActiveBadge.svelte';
	export let seller: SellerType;
</script>

<Card.Root class="transition-all hover:border-zinc-500">
	<Card.Header>
		<Card.Title class="flex justify-between">{seller.name}</Card.Title>
		<Card.Description>
			<ActiveBadge active={seller.active} />
		</Card.Description>
	</Card.Header>
	<Card.Content></Card.Content>
</Card.Root>
