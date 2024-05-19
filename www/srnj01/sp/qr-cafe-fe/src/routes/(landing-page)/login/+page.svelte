<script lang="ts">
	import { goto } from '$app/navigation';
	import { Button } from '$components/ui/button';
	import { Input } from '$components/ui/input';
	import { Label } from '$components/ui/label';
	import { PUBLIC_API_URL } from '$env/static/public';
	import { user } from '$lib';
	import { read } from '$lib/api';
	import { login } from '$lib/api/user';

	let email = 'test@srnka.net';
	let password = 'password';
</script>

<div class="container mt-4">
	<div class="ml-auto mr-auto flex max-w-96 flex-col gap-4 rounded-lg border p-4">
		<form
			class="contents"
			on:submit|preventDefault={async () => {
				const result = await login(email, password);
				if (result.ok) {
					try {
						const userResult = await read(`${PUBLIC_API_URL}/api/user`);
						if (!userResult.ok) {
							throw new Error('Failed to get user');
						}
						user.set(await userResult.json());
					} catch (error) {
						console.error('Failed to get user');
						return;
					}
					goto('/app');
				} else {
					console.error('Failed to login');
				}
			}}
		>
			<Label for="email">Email</Label>
			<Input type="email" required name="email" id="email" bind:value={email} />
			<Label for="password">Password</Label>
			<Input type="password" required name="password" id="password" bind:value={password} />
			<p>
				Don't have an account? <a
					href="/register"
					class="underline transition-all hover:decoration-transparent">Register here for free.</a
				>
			</p>
			<Button type="submit">Login</Button>
		</form>
	</div>
</div>
