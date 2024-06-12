import CardTable from '@/Components/CardTable';
import { CountedPokemonCard } from '@/types';

import { actionColumn, countColumn } from './columns';

interface DetailProps {
    isUserDeckOwner: boolean;
    cards: Array<CountedPokemonCard>;
}

export const DeckCardTable = ({ isUserDeckOwner, cards }: DetailProps) => (
    <CardTable data={cards} additionalColumns={isUserDeckOwner ? [countColumn, actionColumn] : [countColumn]} />
);
