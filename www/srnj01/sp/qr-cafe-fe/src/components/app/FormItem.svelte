<script lang="ts">
	export let row = false;
</script>

<div class="flex gap-2 {row ? 'flex-row items-center' : 'flex-col'}">
	<slot />
</div>
