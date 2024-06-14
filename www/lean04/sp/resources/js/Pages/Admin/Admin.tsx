import { Button, Card, CardBody, Flex, Stack, Text } from '@chakra-ui/react';
import { Head, Link as InertiaLink } from '@inertiajs/react';
import pluralize from 'pluralize';

import Pagination from '@/Components/Pagination';
import SearchInput from '@/Components/SearchInput';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps, User, WithPagination, WithSearchQuery } from '@/types';

import { UserTable } from './UserTable';

interface DetailProps extends PageProps, WithPagination, WithSearchQuery {
    users: Array<User>;
    totalUserCount: number;
}

export default function Admin({ auth, users, totalUserCount, page, totalPages, searchQuery }: DetailProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Users&nbsp;(
                    <Text as="span">{pluralize('user', totalUserCount, true).replace(/ /g, '\u00A0')}</Text>)
                </h2>
            }
        >
            <Head title="Users" />

            <Stack spacing={8}>
                <Card>
                    <CardBody>
                        <Stack spacing={4}>
                            <Flex justifyContent="end">
                                <SearchInput defaultValue={searchQuery} action={route('user.showAll')} autoFocus />
                            </Flex>
                            {users.length === 0 ? null : <UserTable data={users} />}
                        </Stack>
                    </CardBody>
                </Card>
                <Pagination
                    currentPage={page}
                    totalPages={totalPages}
                    renderPage={({ page: pageValue, label, isDisabled }) => (
                        <Button
                            as={InertiaLink}
                            href={route('card.showOwn', { page: pageValue, searchQuery })}
                            key={label}
                            isDisabled={isDisabled}
                        >
                            {label}
                        </Button>
                    )}
                />
            </Stack>
        </AuthenticatedLayout>
    );
}
