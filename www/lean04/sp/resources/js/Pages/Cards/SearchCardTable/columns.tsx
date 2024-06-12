import { createColumnHelper } from '@tanstack/react-table';
import { Card as PokemonCard } from 'pokemon-tcg-sdk-typescript/dist/sdk';

import { SearchCardActionCell } from './cells';

const columnHelper = createColumnHelper<PokemonCard>();

export const actionColumn = columnHelper.display({
    cell: (info) => <SearchCardActionCell pokemonCard={info.row.original} />,
    header: 'Actions',
    enableSorting: false,
});
