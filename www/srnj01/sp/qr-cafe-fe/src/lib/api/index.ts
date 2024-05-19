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
	body?: { [key: string]: string | number | boolean },
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
