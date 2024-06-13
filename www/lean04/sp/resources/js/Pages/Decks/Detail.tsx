import { AddIcon, EditIcon } from '@chakra-ui/icons';
import { Button, Card, CardBody, Flex, HStack, Stack, Text } from '@chakra-ui/react';
import { Head, Link as InertiaLink } from '@inertiajs/react';
import pluralize from 'pluralize';

import Pagination from '@/Components/Pagination';
import SearchInput from '@/Components/SearchInput';
import SharedLayout from '@/Layouts/SharedLayout';
import { CountedPokemonCard, Deck, PageProps, WithPagination, WithSearchQuery } from '@/types';

import { CurrentDeckContext } from './CurrentDeckContext';
import { DeckCardTable } from './DeckCardTable';
import { Delete } from './Delete';

interface DetailProps extends PageProps, WithPagination, WithSearchQuery {
    deck: Deck;
    cards: Array<CountedPokemonCard>;
    totalCardCount: number;
}

export default function Detail({ auth, deck, cards, totalCardCount, page, totalPages, searchQuery }: DetailProps) {
    const isUserDeckOwner = auth.user && (deck.owner_id === auth.user.id || auth.user.privilege >= 1);

    return (
        <SharedLayout
            auth={auth}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {deck.name}&nbsp;(
                    <Text as="span">{pluralize('card', totalCardCount, true).replace(/ /g, '\u00A0')}</Text>)
                </h2>
            }
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
                                {totalCardCount === 0 ? null : (
                                    <SearchInput
                                        defaultValue={searchQuery}
                                        action={route('deck.show', { id: deck.id })}
                                        autoFocus
                                    />
                                )}
                            </Flex>
                            {cards.length === 0 ? null : (
                                <CurrentDeckContext.Provider value={deck}>
                                    <DeckCardTable cards={cards} isUserDeckOwner={isUserDeckOwner} />
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
                            href={route('deck.show', { id: deck.id, page: pageValue, searchQuery })}
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
