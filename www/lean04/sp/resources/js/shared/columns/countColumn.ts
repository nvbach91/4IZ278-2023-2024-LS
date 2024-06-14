import { createColumnHelper } from '@tanstack/react-table';

import { CountedPokemonCard } from '@/types';

export const countColumn = createColumnHelper<CountedPokemonCard>().accessor('count', {
    cell: (info) => info.getValue(),
    header: 'Count',
});
