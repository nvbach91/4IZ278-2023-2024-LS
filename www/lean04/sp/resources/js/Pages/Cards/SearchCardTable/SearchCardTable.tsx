import { useSuspenseQuery } from '@tanstack/react-query';
import { PokemonTCG } from 'pokemon-tcg-sdk-typescript';

import CardTable from '@/Components/CardTable';
import { useAuth } from '@/hooks/useAuth';

import { actionColumn } from './columns';

interface SearchCardTableProps {
    searchValue: string;
}

export default function SearchCardTable({ searchValue }: SearchCardTableProps) {
    const auth = useAuth();

    const { data } = useSuspenseQuery({
        queryKey: ['searchCard', searchValue],
        queryFn: async () => PokemonTCG.findCardsByQueries({ q: `name:"*${searchValue}*"` }),
    });

    return data.length === 0 ? (
        'No cards found.'
    ) : (
        <CardTable data={data} additionalColumns={auth.user ? [actionColumn] : undefined} />
    );
}
