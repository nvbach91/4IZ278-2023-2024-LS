import { PropsWithChildren } from 'react';

import { PageProps } from '../types';

import AuthenticatedLayout from './AuthenticatedLayout';
import GuestLayout from './GuestLayout';

interface SharedLayoutProps extends PageProps {
    header?: JSX.Element;
}

export default function SharedLayout({ auth, header, children }: PropsWithChildren<SharedLayoutProps>) {
    return auth.user ? (
        <AuthenticatedLayout user={auth.user} header={header}>
            {children}
        </AuthenticatedLayout>
    ) : (
        <GuestLayout header={header}>{children}</GuestLayout>
    );
}
