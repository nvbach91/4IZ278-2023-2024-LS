<script>
	import { user } from '$lib';
</script>

<div class="container mt-4">
	You are logged in!
	{#if $user}
		<h1>Welcome back, {$user?.name}</h1>
	{/if}
</div>
