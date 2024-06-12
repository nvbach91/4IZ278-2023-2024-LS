import { createColumnHelper } from '@tanstack/react-table';

import { CountedPokemonCard } from '@/types';

import { CollectionActionCell } from './cells';

const columnHelper = createColumnHelper<CountedPokemonCard>();

export const countColumn = columnHelper.accessor('count', {
    cell: (info) => info.getValue(),
    header: 'Count',
});

export const actionColumn = columnHelper.display({
    cell: (info) => <CollectionActionCell pokemonCard={info.row.original} />,
    header: 'Actions',
});
