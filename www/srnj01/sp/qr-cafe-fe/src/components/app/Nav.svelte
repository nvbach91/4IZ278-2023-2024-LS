<script>
	import { Button } from '$components/ui/button';
	import { logout } from '$lib/api/user';
</script>

<nav class="flex h-16 w-full items-center border-b">
	<div class="container mx-auto flex items-center justify-between">
		<div class="flex items-center">
			<a href="/" class="text-lg">QR Café</a>
		</div>
		<div class="flex items-center gap-2">
			<Button
				on:click={async () => {
					const result = await logout();
					if (result.ok) {
						window.location.href = '/login';
					} else {
						console.error('Failed to logout');
					}
				}}>Logout</Button
			>
		</div>
	</div>
</nav>
