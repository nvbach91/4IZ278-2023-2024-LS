import { AddIcon } from '@chakra-ui/icons';
import { Button, Card, CardBody, Flex, Stack, Text } from '@chakra-ui/react';
import { Head, Link as InertiaLink } from '@inertiajs/react';
import pluralize from 'pluralize';

import Pagination from '@/Components/Pagination';
import SearchInput from '@/Components/SearchInput';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { CountedPokemonCard, PageProps, WithPagination, WithSearchQuery } from '@/types';

import { CollectionCardTable } from './CollectionCardTable';

interface DetailProps extends PageProps, WithPagination, WithSearchQuery {
    cards: Array<CountedPokemonCard>;
    totalCardCount: number;
}

export default function MyCollection({ auth, cards, totalCardCount, page, totalPages, searchQuery }: DetailProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    My collection&nbsp;(
                    <Text as="span">{pluralize('card', totalCardCount, true).replace(/ /g, '\u00A0')}</Text>)
                </h2>
            }
        >
            <Head title="My collection" />

            <Stack spacing={8}>
                <Card>
                    <CardBody>
                        <Stack spacing={4}>
                            <Flex justifyContent="space-between">
                                <Button
                                    as={InertiaLink}
                                    href={route('card.showSearch')}
                                    colorScheme="teal"
                                    leftIcon={<AddIcon />}
                                    size="sm"
                                    variant="outline"
                                >
                                    Add card
                                </Button>
                                <SearchInput defaultValue={searchQuery} action={route('card.showOwn')} autoFocus />
                            </Flex>
                            {cards.length === 0 ? null : <CollectionCardTable cards={cards} />}
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
