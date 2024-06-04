<script lang="ts">
	import { Badge } from '$components/ui/badge/';
	export let active = true;

	export let activeText = 'Activated';
	export let inactiveText = 'Deactivated';
</script>

{#if active}
	<Badge class="bg-lime-600">{activeText}</Badge>
{:else}
	<Badge class="bg-red-800">{inactiveText}</Badge>
{/if}
