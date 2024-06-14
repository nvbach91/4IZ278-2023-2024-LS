import { Card, CardBody, Grid, GridItem, Link } from '@chakra-ui/react';
import { Link as InertiaLink } from '@inertiajs/react';
import pluralize from 'pluralize';

import { Deck } from '@/types';

interface DeckListProps {
    decks: Array<Deck>;
}

export const DeckList = ({ decks }: DeckListProps) => (
    <Grid templateColumns="repeat(3, 1fr)" gap={6}>
        {decks.map((deck) => (
            <GridItem key={deck.id} w="100%">
                <Card>
                    <CardBody>
                        <Link as={InertiaLink} href={route('deck.show', { id: deck.id })}>
                            {deck.name} ({pluralize('card', deck.totalCardCount, true)})
                        </Link>
                    </CardBody>
                </Card>
            </GridItem>
        ))}
    </Grid>
);
