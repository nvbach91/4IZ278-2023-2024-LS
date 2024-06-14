import { usePage } from '@inertiajs/react';

export const useQueryParams = () => {
    const { url } = usePage();

    const queryString = url.split('?')[1] || '';

    const queryParams = new URLSearchParams(queryString);

    const queryParamsObject: Record<string, unknown> = {};

    for (const [key, value] of queryParams) {
        queryParamsObject[key] = value;
    }

    return queryParamsObject;
};
