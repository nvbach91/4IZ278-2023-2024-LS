<script>
	import Button from '$components/ui/button/button.svelte';
	import { copy } from '$lib';

	export let text;

	let copied = false;
</script>

<Button
	on:click={() => {
		copy(text);
		copied = true;
		setTimeout(() => {
			copied = false;
		}, 2000);
	}}
	class="flex items-center gap-2 text-gray-500 hover:bg-transparent"
	variant="outline"
>
	<slot {copied} />
</Button>
