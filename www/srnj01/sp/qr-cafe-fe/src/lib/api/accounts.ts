import type { Account } from '$types/user';
import { buildUrl, read } from '.';

export const getAccounts = async (
	seller_hash: string | undefined = undefined
): Promise<Account[] | null> => {
	const result = await read(
		buildUrl(`/api${seller_hash !== undefined ? `/seller/${seller_hash}` : ''}/accounts`)
	);
	if (result.ok) {
		return (await result.json()) as Account[];
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch accounts');
};
