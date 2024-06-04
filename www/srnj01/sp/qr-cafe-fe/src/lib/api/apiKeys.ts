import type { ApiKey, ApiKeyAdd } from '$types/user';
import { buildUrl, read, create, remove } from '.';

export const getApiKeys = async (): Promise<ApiKey[] | null> => {
	const result = await read(buildUrl('/api/api_keys'));
	if (result.ok) {
		return (await result.json()) as ApiKey[];
	}
	throw new Error('Failed to fetch api keys');
};

export const createApiKey = async (account: ApiKeyAdd): Promise<ApiKey> => {
	const result = await create(buildUrl('/api/api_keys'), account);
	if (result.ok) {
		return (await result.json()) as ApiKey;
	}
	throw new Error('Failed to add api key');
};

export const deleteApiKey = async (id: string): Promise<void> => {
	const result = await remove(buildUrl(`/api/api_keys/${id}`));
	if (!result.ok) {
		throw new Error('Failed to delete api key');
	}
};
