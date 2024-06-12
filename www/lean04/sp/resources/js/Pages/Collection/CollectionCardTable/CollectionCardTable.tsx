import CardTable from '@/Components/CardTable';
import { CountedPokemonCard } from '@/types';

import { actionColumn, countColumn } from './columns';

interface CollectionCardTableProps {
    cards: Array<CountedPokemonCard>;
}

export const CollectionCardTable = ({ cards }: CollectionCardTableProps) =>
    cards.length === 0 ? null : <CardTable data={cards} additionalColumns={[countColumn, actionColumn]} />;
