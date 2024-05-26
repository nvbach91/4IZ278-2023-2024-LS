<script lang="ts">
	import { CheckCircle2, CircleAlert } from 'lucide-svelte';
	export let paid = true;
</script>

<div
	class="flex w-full items-center justify-between gap-2 rounded-lg {paid
		? 'bg-lime-600'
		: 'bg-red-800'} pb-2 pl-4 pr-4 pt-2 text-white"
>
	{#if paid}
		This payment has been paid
		<CheckCircle2 size={16} />
	{:else}
		This payment has not been paid
		<CircleAlert size={16} />
	{/if}
</div>
