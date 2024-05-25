<script lang="ts">
	import { PUBLIC_API_URL } from '$env/static/public';
	import { onMount } from 'svelte';
	import { create, read } from '$lib/api';

	const register = async (
		name: string,
		email: string,
		password: string,
		passwordConfirmation: string
	) => {
		const res = await fetch(`${PUBLIC_API_URL}/register`, {
			method: 'POST',
			credentials: 'include',
			headers: {
				'Content-Type': 'application/json',
				Accept: 'application/json',
				'X-XSRF-TOKEN': decodeURIComponent(
					document.cookie.replace(/(?:(?:^|.*;\s*)XSRF-TOKEN\s*=\s*([^;]*).*$)|^.*$/, '$1')
				)
			},
			body: JSON.stringify({ name, email, password, password_confirmation: passwordConfirmation })
		});
		const data = await res.json();
		console.log(data);
	};

	const login = async (email: string, password: string) => {
		const res = await fetch(`${PUBLIC_API_URL}/login`, {
			method: 'POST',
			credentials: 'include',
			headers: {
				'Content-Type': 'application/json',
				Accept: 'application/json',
				'X-XSRF-TOKEN': decodeURIComponent(
					document.cookie.replace(/(?:(?:^|.*;\s*)XSRF-TOKEN\s*=\s*([^;]*).*$)|^.*$/, '$1')
				)
			},
			body: JSON.stringify({ email, password })
		});
		const data = await res.json();
		console.log(data);
	};

	const fetchUser = async () => {
		const res = await fetch(`${PUBLIC_API_URL}/api/user`, {
			method: 'GET',
			credentials: 'include',
			headers: {
				'Content-Type': 'application/json',
				Accept: 'application/json',
				'X-XSRF-TOKEN': decodeURIComponent(
					document.cookie.replace(/(?:(?:^|.*;\s*)XSRF-TOKEN\s*=\s*([^;]*).*$)|^.*$/, '$1')
				)
			}
		});
		const data = await res.json();
		console.log(data);
	};

	const logout = async () => {
		await fetch(`${PUBLIC_API_URL}/logout`, {
			method: 'POST',
			credentials: 'include',
			headers: {
				'Content-Type': 'application/json',
				Accept: 'application/json',
				'X-XSRF-TOKEN': decodeURIComponent(
					document.cookie.replace(/(?:(?:^|.*;\s*)XSRF-TOKEN\s*=\s*([^;]*).*$)|^.*$/, '$1')
				)
			}
		}).then(() => {
			console.log('Logged out');
		});
	};

	const getData = async (url: string) => {
		const res = await read(`${PUBLIC_API_URL}/api/${url}`);
		const data = await res.json();
		console.log(data);
	};

	const createData = async (url: string, data: { [key: string]: string | number | boolean }) => {
		const res = await create(`${PUBLIC_API_URL}/api/${url}`, data);
		const resData = await res.json();
		console.log(resData);
	};

	const deleteData = async (id: string) => {
		const res = await fetch(`${PUBLIC_API_URL}/api/clients/${id}`, {
			method: 'DELETE',
			credentials: 'include',
			headers: {
				'Content-Type': 'application/json',
				Accept: 'application/json',
				'X-XSRF-TOKEN': decodeURIComponent(
					document.cookie.replace(/(?:(?:^|.*;\s*)XSRF-TOKEN\s*=\s*([^;]*).*$)|^.*$/, '$1')
				)
			}
		});
		if (res.status === 204) {
			console.log('Deleted');
		} else {
			const data = await res.json();
			console.log(data);
		}
	};

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
	});

	let toDecode = '';

	let name = 'Test';
	let email = 'test@srnka.net';
	let password = 'password';
	let passwordConfirmation = 'password';

	let loginName = 'test@srnka.net';
	let loginPassword = 'password';

	let dataName = 'Test Data';
	let dataActive = true;
	let dataFee = '10';

	let deleteId = '';
</script>

<h1>Welcome to SvelteKit</h1>
<p>Visit <a href="https://kit.svelte.dev">kit.svelte.dev</a> to read the documentation</p>

<form
	on:submit|preventDefault={() => {
		const data = {
			name: dataName,
			active: dataActive,
			fee: dataFee
		};
		createData('clients', data);
	}}
>
	<label for="dataName">Name:</label>
	<input type="text" id="dataName" bind:value={dataName} />

	<label for="dataFee">Fee:</label>
	<input type="number" id="dataFee" bind:value={dataFee} />

	<button type="submit">Create Data</button>
</form>

<hr />

<form
	on:submit|preventDefault={() => {
		const data = {
			name: dataName,
			active: dataActive,
			fee: dataFee
		};
		createData('clients', data);
	}}
>
	<label for="dataName">Name:</label>
	<input type="text" id="dataName" bind:value={dataName} />

	<label for="dataFee">Fee:</label>
	<input type="number" id="dataFee" bind:value={dataFee} />

	<button type="submit">Create Data</button>
</form>

<hr />

<form
	on:submit|preventDefault={() => {
		deleteData(deleteId);
	}}
>
	<label for="deleteId">ID:</label>
	<input type="text" id="deleteId" bind:value={deleteId} />

	<button type="submit">Delete Data</button>
</form>

<hr />

<form
	on:submit={() => {
		login(loginName, loginPassword);
	}}
>
	<label for="loginName">Email:</label>
	<input type="email" id="loginName" bind:value={loginName} />

	<label for="loginPassword">Password:</label>
	<input type="password" id="loginPassword" bind:value={loginPassword} />

	<button type="submit">Login</button>
</form>

<hr />

<button on:click={() => fetchUser()}>Fetch User</button>
<button on:click={() => logout()}>Logout</button>
<button on:click={() => getData('clients')}>Get Clients</button>
<button on:click={() => getData('sellers')}>Get Sellers</button>
<button on:click={() => getData('api_keys')}>Get API Keys</button>
<button on:click={() => getData('generated')}>Get Generated</button>
<br />
<button on:click={() => getData('generated?seller_hash=hash1')}>Get Generated as Seller</button>
<button
	on:click={() =>
		createData('generated', {
			seller_hash: 'hash1',
			amount: 100,
			variable_symbol: '123456',
			account_id: 1
		})}>Create Generated as Seller</button
>

<hr />

<form
	on:submit|preventDefault={() => {
		register(name, email, password, passwordConfirmation);
	}}
>
	<label for="name">Name:</label>
	<input type="text" id="name" bind:value={name} />

	<label for="email">Email:</label>
	<input type="email" id="email" bind:value={email} />

	<label for="password">Password:</label>
	<input type="password" id="password" bind:value={password} />

	<label for="passwordConfirmation">Password Confirmation:</label>
	<input type="password" id="passwordConfirmation" bind:value={passwordConfirmation} />

	<button type="submit">Register</button>
</form>

<hr />

<textarea bind:value={toDecode} cols="40" rows="20"></textarea>

<h3>Decoded:</h3>
<p>{decodeURIComponent(toDecode)}</p>

<style>
	p {
		max-width: 90vw;
		/* break words */
		word-wrap: break-word;
	}
	form {
		display: flex;
		flex-direction: column;
		gap: 8px;
		max-width: 300px;
	}
</style>
