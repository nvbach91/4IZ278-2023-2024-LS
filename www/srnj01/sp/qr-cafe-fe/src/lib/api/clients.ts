import type { Client } from '$types/user';
import { buildUrl, read } from '.';

export const getClients = async (): Promise<Client[] | null> => {
	const result = await read(buildUrl('/api/clients'));
	if (result.ok) {
		return (await result.json()) as Client[];
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch clients');
};

export const getClient = async (id: string): Promise<Client | null> => {
	const result = await read(buildUrl(`/api/clients/${id}`));
	if (result.ok) {
		return (await result.json()) as Client;
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch client');
};
