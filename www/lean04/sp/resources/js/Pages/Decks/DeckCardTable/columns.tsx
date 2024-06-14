import { createColumnHelper } from '@tanstack/react-table';

import { CountedPokemonCard } from '@/types';

import { DeckActionCell } from './cells';

const columnHelper = createColumnHelper<CountedPokemonCard>();

export const actionColumn = columnHelper.display({
    cell: (info) => <DeckActionCell pokemonCard={info.row.original} />,
    header: 'Actions',
    enableSorting: false,
});
