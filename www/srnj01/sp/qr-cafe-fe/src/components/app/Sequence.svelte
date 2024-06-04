<script lang="ts">
	import * as Card from '$components/ui/card';
	import type { Sequence } from '$types/user';

	export let sequence: Sequence;
</script>

<Card.Root class="transition-all hover:border-zinc-500">
	<Card.Header>
		<Card.Title>{sequence.generator}</Card.Title>
	</Card.Header>
	<Card.Content>
		<p>Last Used: {sequence.last_used}</p>
	</Card.Content>
</Card.Root>
