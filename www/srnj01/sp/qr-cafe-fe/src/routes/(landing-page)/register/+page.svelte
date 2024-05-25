<script lang="ts">
	import { goto } from '$app/navigation';
	import { Button } from '$components/ui/button';
	import { Input } from '$components/ui/input';
	import { Label } from '$components/ui/label';
	import { register } from '$lib/api/user';

	let name = 'Test';
	let email = 'test@srnka.net';
	let password = 'password';
	let passwordConfirmation = 'password';

	let loading = false;
</script>

<div class="container mt-4">
	<div class="ml-auto mr-auto flex max-w-96 flex-col gap-4 rounded-lg border p-4">
		<form
			class="contents"
			on:submit|preventDefault={async () => {
				loading = true;
				const result = await register(name, email, password, passwordConfirmation);
				if (result.ok) {
					loading = false;
					goto('/app');
				} else {
					loading = false;
					console.error('Failed to register');
				}
			}}
		>
			<Label for="name">Name</Label>
			<Input type="text" required name="name" id="name" bind:value={name} />
			<Label for="email">Email</Label>
			<Input type="email" required name="email" id="email" bind:value={email} />
			<Label for="password">Password</Label>
			<Input type="password" required name="password" id="password" bind:value={password} />
			<Label for="passwordConfirmation">Confirm Password</Label>
			<Input
				type="password"
				required
				name="passwordConfirmation"
				id="passwordConfirmation"
				bind:value={passwordConfirmation}
			/>
			<p>
				Already have an account? <a
					href="/login"
					class="underline transition-all hover:decoration-transparent">Login here.</a
				>
			</p>
			<Button type="submit" variant={loading ? 'ghost' : 'default'} disabled={loading}
				>Register</Button
			>
		</form>
	</div>
</div>
