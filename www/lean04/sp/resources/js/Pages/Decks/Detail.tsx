import { useState } from 'react';
import { AddIcon, EditIcon } from '@chakra-ui/icons';
import { Button, Card, CardBody, Flex, HStack, Stack, Text } from '@chakra-ui/react';
import { Head, Link as InertiaLink } from '@inertiajs/react';
import pluralize from 'pluralize';

import Pagination from '@/Components/Pagination';
import CountedPokemonCardsContext from '@/contexts/CountedPokemonCardsContext';
import SharedLayout from '@/Layouts/SharedLayout';
import { CountedPokemonCard, Deck, PageProps, WithPagination } from '@/types';

import { CurrentDeckContext } from './CurrentDeckContext';
import { DeckCardTable } from './DeckCardTable';
import { Delete } from './Delete';

interface DetailProps extends PageProps, WithPagination {
    deck: Deck;
    cards: Array<CountedPokemonCard>;
}

export default function Detail({ auth, deck, cards: data, page, totalPages }: DetailProps) {
    const [cards, setCards] = useState<Array<CountedPokemonCard>>(data);

    const isUserDeckOwner = auth.user && deck.owner_id === auth.user.id;

    return (
        <SharedLayout
            auth={auth}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">{deck.name}</h2>}
        >
            <Head title={deck.name} />

            <Stack spacing={6}>
                {isUserDeckOwner ? (
                    <HStack>
                        <Button
                            as={InertiaLink}
                            href={route('deck.edit', { id: deck.id })}
                            colorScheme="teal"
                            leftIcon={<EditIcon />}
                        >
                            Edit
                        </Button>
                        <Delete deck={deck} />
                    </HStack>
                ) : null}
                <Card>
                    <CardBody>
                        <Stack spacing={4}>
                            <Flex justifyContent="space-between">
                                <Text>
                                    {pluralize(
                                        'card',
                                        cards.reduce((count, card) => count + card.count, 0),
                                        true
                                    )}
                                </Text>
                                {isUserDeckOwner ? (
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
                                ) : null}
                            </Flex>
                            {cards.length === 0 ? null : (
                                <CurrentDeckContext.Provider value={deck}>
                                    <CountedPokemonCardsContext.Provider value={{ cards, setCards }}>
                                        <DeckCardTable cards={cards} isUserDeckOwner={isUserDeckOwner} />
                                    </CountedPokemonCardsContext.Provider>
                                </CurrentDeckContext.Provider>
                            )}
                        </Stack>
                    </CardBody>
                </Card>
                <Pagination
                    currentPage={page}
                    totalPages={totalPages}
                    renderPage={({ page: pageValue, label, isDisabled }) => (
                        <Button
                            as={InertiaLink}
                            href={route('deck.show', { id: deck.id, page: pageValue })}
                            key={label}
                            isDisabled={isDisabled}
                        >
                            {label}
                        </Button>
                    )}
                />
            </Stack>
        </SharedLayout>
    );
}
