import type { Seller, SellerAdd, SellerEditable } from '$types/user';
import { buildUrl, create, read, update } from '.';

export const getSellers = async (): Promise<Seller[] | null> => {
	const result = await read(buildUrl('/api/sellers'));
	if (result.ok) {
		return (await result.json()) as Seller[];
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch sellers');
};

export const getSeller = async (id: string): Promise<Seller | null> => {
	const result = await read(buildUrl(`/api/sellers/${id}`));
	if (result.ok) {
		return (await result.json()) as Seller;
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch seller');
};

export const getSellerByHash = async (hash: string): Promise<Seller | null> => {
	const result = await read(buildUrl(`/api/seller/${hash}`));
	if (result.ok) {
		return (await result.json()) as Seller;
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch seller');
};

export const updateSeller = async (id: string, seller: SellerEditable): Promise<Seller> => {
	const result = await update(buildUrl(`/api/sellers/${id}`), seller);
	if (result.ok) {
		return (await result.json()) as Seller;
	}
	throw new Error('Failed to update client');
};

export const createSeller = async (seller: SellerAdd): Promise<Seller> => {
	const result = await create(buildUrl('/api/sellers'), seller);
	if (result.ok) {
		return (await result.json()) as Seller;
	}
	throw new Error('Failed to add seller');
};
