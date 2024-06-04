<script lang="ts">
	export let message: string | undefined = undefined;
</script>

<div class="mt-4 flex flex-col gap-4">
	{#if message}
		<p class="text-red-600">{message}</p>
	{/if}
	<slot />
</div>
