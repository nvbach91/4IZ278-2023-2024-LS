import type { Client, ClientAdd, ClientEditable } from '$types/user';
import { buildUrl, create, read, remove, update } from '.';

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

export const updateClient = async (id: string, client: ClientEditable): Promise<Client> => {
	const result = await update(buildUrl(`/api/clients/${id}`), client);
	if (result.ok) {
		return (await result.json()) as Client;
	}
	throw new Error('Failed to update client');
};

export const createClient = async (client: ClientAdd): Promise<Client> => {
	const result = await create(buildUrl('/api/clients'), client);
	if (result.ok) {
		return (await result.json()) as Client;
	}
	throw new Error('Failed to add client');
};

export const deleteClient = async (id: string): Promise<void> => {
	const result = await remove(buildUrl(`/api/clients/${id}`));
	if (!result.ok) {
		throw new Error('Failed to delete client');
	}
};
