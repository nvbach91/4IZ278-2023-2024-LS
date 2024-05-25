<script lang="ts">
	import { Badge } from '$components/ui/badge/';
	export let active = true;
</script>

{#if active}
	<Badge class="bg-lime-600">Active</Badge>
{:else}
	<Badge class="bg-red-800">Inactive</Badge>
{/if}
