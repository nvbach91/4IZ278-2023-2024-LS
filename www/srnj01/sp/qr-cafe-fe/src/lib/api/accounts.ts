import type { Account, AccountAdd, AccountEditable } from '$types/user';
import { buildUrl, read, create, update, remove } from '.';

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

export const getAccount = async (
	id: number,
	seller_hash: string | undefined = undefined
): Promise<Account | null> => {
	const result = await read(
		buildUrl(`/api${seller_hash !== undefined ? `/seller/${seller_hash}` : ''}/accounts/${id}`)
	);
	if (result.ok) {
		return (await result.json()) as Account;
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch account');
};

export const createAccount = async (account: AccountAdd): Promise<Account> => {
	const result = await create(buildUrl(`/api/accounts`), account);
	if (result.ok) {
		return (await result.json()) as Account;
	}
	throw new Error('Failed to add account');
};

export const updateAccount = async (id: number, account: AccountEditable): Promise<Account> => {
	const result = await update(buildUrl(`/api/accounts/${id}`), account);
	if (result.ok) {
		return (await result.json()) as Account;
	}
	throw new Error('Failed to update account');
};

export const deleteAccount = async (id: string): Promise<void> => {
	const result = await remove(buildUrl(`/api/accounts/${id}`));
	if (!result.ok) {
		throw new Error('Failed to delete account');
	}
};
