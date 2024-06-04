<script lang="ts">
	import { goto } from '$app/navigation';
	import Nav from '$components/app/Nav.svelte';
	import { PUBLIC_API_URL } from '$env/static/public';
	import { read } from '$lib/api';
	import { onMount } from 'svelte';

	onMount(async () => {
		try {
			const result = await read(`${PUBLIC_API_URL}/api/user`);
			if (!result.ok) {
				goto('/login');
			}
		} catch (error) {
			goto('/login');
		}
	});
</script>

<Nav />

<slot />
