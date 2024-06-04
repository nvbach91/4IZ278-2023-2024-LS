import { PUBLIC_API_URL } from '$env/static/public';

export const buildUrl = (path: string) => `${PUBLIC_API_URL}${path}`;

export const customFetch = async (route: string, options: RequestInit) =>
	fetch(route, {
		credentials: 'include',
		...options,
		headers: {
			'Content-Type': 'application/json',
			Accept: 'application/json',
			'X-XSRF-TOKEN': decodeURIComponent(
				document.cookie.replace(/(?:(?:^|.*;\s*)XSRF-TOKEN\s*=\s*([^;]*).*$)|^.*$/, '$1')
			),
			...options.headers
		}
	});

export const create = (
	route: string,
	body?: { [key: string]: string | number | boolean | null },
	method = 'POST'
) =>
	customFetch(route, {
		method,
		body: JSON.stringify(body)
	});

export const read = (route: string, method = 'GET') =>
	customFetch(route, {
		method
	});

export const update = (
	route: string,
	body: { [key: string]: string | number | boolean | null },
	method = 'PATCH'
) =>
	customFetch(route, {
		method,
		body: JSON.stringify(body)
	});

export const remove = (route: string) =>
	customFetch(route, {
		method: 'DELETE'
	});

export const randomChars = (length: number): string => {
	const CHARACTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	return Array.from({ length }, () =>
		CHARACTERS.charAt(Math.floor(Math.random() * CHARACTERS.length))
	).join('');
};

export const createHash = (): string => {
	const timestamp = new Date().getTime();
	return timestamp
		.toString()
		.split('')
		.map((a) => {
			return `${a}${randomChars(2)}`;
		})
		.join('');
};
