import type { Sequence, SequenceAdd, SequenceEditable } from '$types/user';
import { buildUrl, create, read, remove, update } from '.';

export const getSequences = async (): Promise<Sequence[] | null> => {
	const result = await read(buildUrl('/api/sequences'));
	if (result.ok) {
		return (await result.json()) as Sequence[];
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch sequences');
};

export const getSequence = async (id: string): Promise<Sequence | null> => {
	const result = await read(buildUrl(`/api/sequences/${id}`));
	if (result.ok) {
		return (await result.json()) as Sequence;
	} else if (result.status === 404 || result.status === 403) {
		return null;
	}
	throw new Error('Failed to fetch sequence');
};

export const updateSequence = async (id: string, sequence: SequenceEditable): Promise<Sequence> => {
	const result = await update(buildUrl(`/api/sequences/${id}`), sequence);
	if (result.ok) {
		return (await result.json()) as Sequence;
	}
	throw new Error('Failed to update sequence');
};

export const createSequence = async (sequence: SequenceAdd): Promise<Sequence> => {
	const result = await create(buildUrl('/api/sequences'), sequence);
	if (result.ok) {
		return (await result.json()) as Sequence;
	}
	throw new Error('Failed to add sequence');
};

export const deleteSequence = async (id: string): Promise<void> => {
	const result = await remove(buildUrl(`/api/sequences/${id}`));
	if (!result.ok) {
		throw new Error('Failed to delete sequence');
	}
};

export const generateNext = async (
	id: string,
	hash: string | undefined = undefined
): Promise<Sequence> => {
	const result = await read(
		buildUrl(`/api${hash ? `/seller/${hash}` : ''}/sequences/${id}/generate`)
	);
	if (result.ok) {
		return (await result.json()) as Sequence;
	}
	throw new Error('Failed to generate next sequence');
};
