<script lang="ts">
	import { Badge } from '$components/ui/badge/';
	export let active = true;
</script>

{#if active}
	<Badge class="bg-lime-600">Activated</Badge>
{:else}
	<Badge class="bg-red-800">Deactivated</Badge>
{/if}
