<script lang="ts">
	import { Button } from '$components/ui/button';
	import { user } from '$lib';
	import { logout } from '$lib/api/user';
</script>

<nav class="flex h-16 w-full items-center border-b">
	<div class="container mx-auto flex items-center justify-between">
		<div class="flex items-center">
			<a href="/" class="text-lg">QR Café</a>
		</div>
		<div class="flex items-center gap-2">
			{#if $user}
				<a href="/app"><Button>Go to App</Button></a>
				<Button
					variant="outline"
					on:click={async () => {
						const result = await logout();
						if (result.ok) {
							user.set(null);
							window.location.href = '/login';
						} else {
							console.error('Failed to logout');
						}
					}}>Logout</Button
				>
			{:else}
				<a href="/login"><Button>Login</Button></a>
				<a href="/register"><Button variant="outline">Register</Button></a>
			{/if}
		</div>
	</div>
</nav>
