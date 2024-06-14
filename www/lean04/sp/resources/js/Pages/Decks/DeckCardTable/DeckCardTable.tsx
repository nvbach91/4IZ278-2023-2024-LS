import CardTable from '@/Components/CardTable';
import { countColumn } from '@/shared/columns/countColumn';
import { CountedPokemonCard } from '@/types';

import { actionColumn } from './columns';

interface DetailProps {
    isUserDeckOwner: boolean;
    cards: Array<CountedPokemonCard>;
}

export const DeckCardTable = ({ isUserDeckOwner, cards }: DetailProps) => (
    <CardTable data={cards} additionalColumns={isUserDeckOwner ? [countColumn, actionColumn] : [countColumn]} />
);
