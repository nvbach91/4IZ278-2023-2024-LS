<script lang="ts">
	import * as Card from '$components/ui/card';
	import { user } from '$lib';
</script>

{#if $user}
	<Card.Root class="w-full min-w-64 max-w-96">
		<Card.Header>
			<Card.Title>Welcome back, {$user.name}</Card.Title>
		</Card.Header>
	</Card.Root>
{/if}
