import type { Generated, GeneratedAdd, GeneratedEditable } from '$types/user';
import { buildUrl, create, read, remove, update } from '.';

export const getGenerated = async (
	seller_hash: string | undefined = undefined
): Promise<Generated[] | null> => {
	const result = await read(
		buildUrl(`/api${seller_hash !== undefined ? `/seller/${seller_hash}` : ''}/generated`)
	);
	if (result.ok) {
		return (await result.json()) as Generated[];
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch generated');
};

export const getSingleGenerated = async (
	id: string,
	seller_hash: string | undefined = undefined
): Promise<Generated | null> => {
	const result = await read(
		buildUrl(`/api${seller_hash !== undefined ? `/seller/${seller_hash}` : ''}/generated/${id}`)
	);
	if (result.ok) {
		return (await result.json()) as Generated;
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch generated');
};

export const createGenerated = async (
	generated: GeneratedAdd,
	seller_hash: string | undefined = undefined
): Promise<Generated> => {
	const result = await create(
		buildUrl(`/api${seller_hash !== undefined ? `/seller/${seller_hash}` : ''}/generated`),
		generated
	);
	if (result.ok) {
		return (await result.json()) as Generated;
	}
	throw new Error('Failed to add generated');
};

export const updateGenerated = async (
	id: string,
	generated: GeneratedEditable
): Promise<Generated> => {
	const result = await update(buildUrl(`/api/generated/${id}`), generated);
	if (result.ok) {
		return (await result.json()) as Generated;
	}
	throw new Error('Failed to update generated');
};

export const deleteGenerated = async (id: string): Promise<void> => {
	const result = await remove(buildUrl(`/api/generated/${id}`));
	if (!result.ok) {
		throw new Error('Failed to delete generated');
	}
};
