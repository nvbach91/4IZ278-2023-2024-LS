import { useState } from 'react';
import { AddIcon } from '@chakra-ui/icons';
import { Button, Card, CardBody, Flex, Stack, Text } from '@chakra-ui/react';
import { Head, Link as InertiaLink } from '@inertiajs/react';
import pluralize from 'pluralize';

import CountedPokemonCardsContext from '@/contexts/CountedPokemonCardsContext';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { CountedPokemonCard, PageProps, WithPagination } from '@/types';

import Pagination from '../../Components/Pagination';

import { CollectionCardTable } from './CollectionCardTable';

interface DetailProps extends PageProps, WithPagination {
    cards: Array<CountedPokemonCard>;
    totalCardCount: number;
}

export default function MyCollection({ auth, cards: data, totalCardCount, page, totalPages }: DetailProps) {
    const [cards, setCards] = useState<Array<CountedPokemonCard>>(data);
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">My collection</h2>}
        >
            <Head title="My collection" />

            <Stack spacing={8}>
                <Card>
                    <CardBody>
                        <Stack spacing={4}>
                            <Flex justifyContent="space-between">
                                <Text>{pluralize('card', totalCardCount, true)}</Text>
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
                            </Flex>
                            <CountedPokemonCardsContext.Provider value={{ cards, setCards }}>
                                {cards.length === 0 ? null : <CollectionCardTable cards={cards} />}
                            </CountedPokemonCardsContext.Provider>
                        </Stack>
                    </CardBody>
                </Card>
                <Pagination
                    currentPage={page}
                    totalPages={totalPages}
                    renderPage={({ page: pageValue, label, isDisabled }) => (
                        <Button
                            as={InertiaLink}
                            href={route('card.showOwn', { page: pageValue })}
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
