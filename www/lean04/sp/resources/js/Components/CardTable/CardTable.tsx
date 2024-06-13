import { useState } from 'react';
import { Table as ChakraTable, Tbody, Tfoot, Thead } from '@chakra-ui/react';
import { ColumnDef, getCoreRowModel, getSortedRowModel, SortingState, useReactTable } from '@tanstack/react-table';
import { Card as PokemonCard } from 'pokemon-tcg-sdk-typescript/dist/sdk';

import { BodyRow, HeadRow } from '../table';

import { columns } from './columns';

export interface CardTableProps<T extends PokemonCard> {
    data: Array<T>;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    additionalColumns?: Array<ColumnDef<T, any>>;
}

export default function Table<T extends PokemonCard>({ data, additionalColumns }: CardTableProps<T>) {
    const [sorting, setSorting] = useState<SortingState>([]);
    const table = useReactTable<T>({
        // @ts-expect-error
        columns: additionalColumns ? [...columns, ...additionalColumns] : columns,
        data,
        getCoreRowModel: getCoreRowModel(),
        getSortedRowModel: getSortedRowModel(),
        onSortingChange: setSorting,
        state: {
            sorting,
        },
    });

    return (
        <ChakraTable>
            <Thead>
                {table.getHeaderGroups().map((headerGroup) => (
                    <HeadRow<PokemonCard> key={headerGroup.id} headerGroup={headerGroup} />
                ))}
            </Thead>
            <Tbody>
                {table.getRowModel().rows.map((row) => (
                    <BodyRow<PokemonCard> key={row.id} row={row} />
                ))}
            </Tbody>
            <Tfoot>
                {table.getFooterGroups().map((footerGroup) => (
                    <HeadRow<PokemonCard> key={footerGroup.id} headerGroup={footerGroup} />
                ))}
            </Tfoot>
        </ChakraTable>
    );
}
