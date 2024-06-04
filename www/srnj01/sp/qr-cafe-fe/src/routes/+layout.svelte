<script lang="ts">
	import { onMount } from 'svelte';
	import '../app.css';
	import { PUBLIC_API_URL } from '$env/static/public';
	import { user } from '$lib';
	import { read } from '$lib/api';
	import { Toaster } from '$components/ui/sonner';
	import { setMode } from 'mode-watcher';

	setMode('light');

	onMount(async () => {
		try {
			const cookie = await fetch(`${PUBLIC_API_URL}/sanctum/csrf-cookie`, {
				method: 'GET',
				credentials: 'include',
				headers: {
					'Content-Type': 'application/json',
					Accept: 'application/json'
				}
			});

			console.log(cookie);
		} catch (error) {
			console.error(error);
		}

		try {
			const result = await read(`${PUBLIC_API_URL}/api/user`);
			if (result.ok) {
				const json = await result.json();
				user.set(json);
			}
		} catch (error) {
			console.error(error);
		}
	});
</script>

<Toaster theme="light" />

<slot />
