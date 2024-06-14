import { Button, Stack } from '@chakra-ui/react';
import { Head, Link as InertiaLink } from '@inertiajs/react';

import Pagination from '@/Components/Pagination';
import SharedLayout from '@/Layouts/SharedLayout';
import { Deck, PageProps, WithPagination } from '@/types';

import { DeckList } from './DeckList';

interface MyProps extends PageProps, WithPagination {
    decks: Array<Deck>;
}

export default function MyDecks({ auth, decks, page, totalPages }: MyProps) {
    return (
        <SharedLayout
            auth={auth}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Explore decks</h2>}
        >
            <Head title="Explore decks" />

            <Stack spacing={8}>
                <DeckList decks={decks} />
                <Pagination
                    currentPage={page}
                    totalPages={totalPages}
                    renderPage={({ page: pageValue, label, isDisabled }) => (
                        <Button
                            as={InertiaLink}
                            href={route('deck.showAll', { page: pageValue })}
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
