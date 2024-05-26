import type { PageLoad } from './$types';

export const load: PageLoad = async ({ params }) => {
	return {
		hash: params.hash,
		payment: params.payment
	};
};
