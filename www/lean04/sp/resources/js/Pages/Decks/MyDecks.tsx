import { AddIcon } from '@chakra-ui/icons';
import { Box, Button, Stack } from '@chakra-ui/react';
import { Head, Link as InertiaLink } from '@inertiajs/react';

import Pagination from '@/Components/Pagination';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Deck, PageProps, WithPagination } from '@/types';

import { DeckList } from './DeckList';

interface MyProps extends PageProps, WithPagination {
    decks: Array<Deck>;
}

export default function MyDecks({ auth, decks, page, totalPages }: MyProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">My decks</h2>}
        >
            <Head title="My decks" />

            <Stack spacing={8}>
                <Box>
                    <Button as={InertiaLink} href={route('deck.add')} colorScheme="teal" leftIcon={<AddIcon />}>
                        Add new deck
                    </Button>
                </Box>
                <DeckList decks={decks} />
                <Pagination
                    currentPage={page}
                    totalPages={totalPages}
                    renderPage={({ page: pageValue, label, isDisabled }) => (
                        <Button
                            as={InertiaLink}
                            href={route('deck.showOwn', { page: pageValue })}
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
