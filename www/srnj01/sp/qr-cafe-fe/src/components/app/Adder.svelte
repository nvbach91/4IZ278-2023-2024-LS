<script>
	import { Card } from '$components/ui/card';
	import { Plus } from 'lucide-svelte';
</script>

<Card
	class="h-full min-w-64 max-w-96 cursor-pointer pb-8  pt-8 transition-all hover:border-zinc-500"
>
	<div class="grid h-full place-content-center">
		<div class="flex gap-2">
			Add New
			<Plus />
		</div>
	</div>
</Card>
