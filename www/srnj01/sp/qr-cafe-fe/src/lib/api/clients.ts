import type { Client } from '$types/user';
import { buildUrl, read } from '.';

export const getClients = async (): Promise<Client[]> => {
	const result = await read(buildUrl('/api/clients'));
	if (result.ok) {
		return (await result.json()) as Client[];
	}
	throw new Error('Failed to fetch clients');
};
