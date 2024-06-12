import { Card, CardBody, Stack } from '@chakra-ui/react';
import { Head } from '@inertiajs/react';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';

import DeleteUserForm from './Partials/DeleteUserForm';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';

export default function Edit({
    auth,
    mustVerifyEmail,
    status,
}: PageProps<{ mustVerifyEmail: boolean; status?: string }>) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>}
        >
            <Head title="Profile" />

            <Stack spacing={6}>
                <Card>
                    <CardBody p={6}>
                        <UpdateProfileInformationForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            className="max-w-xl"
                        />
                    </CardBody>
                </Card>

                <Card>
                    <CardBody p={6}>
                        <UpdatePasswordForm className="max-w-xl" />
                    </CardBody>
                </Card>

                <Card>
                    <CardBody p={6}>
                        <DeleteUserForm className="max-w-xl" />
                    </CardBody>
                </Card>
            </Stack>
        </AuthenticatedLayout>
    );
}
