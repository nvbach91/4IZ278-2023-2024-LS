import { usePage } from '@inertiajs/react';

import { PageProps } from '../types';

export const useAuth = () => {
    const page = usePage<PageProps>();
    return page.props.auth;
};
