import { useState } from 'react';
import { Table as ChakraTable, Tbody, Tfoot, Thead } from '@chakra-ui/react';
import { getCoreRowModel, getSortedRowModel, SortingState, useReactTable } from '@tanstack/react-table';

import { BodyRow, HeadRow } from '@/Components/table';
import { User } from '@/types';

import { columns } from './columns';

export interface UserTableProps {
    data: Array<User>;
}

export default function UserTable({ data }: UserTableProps) {
    const [sorting, setSorting] = useState<SortingState>([]);
    const table = useReactTable<User>({
        columns,
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
                    <HeadRow<User> key={headerGroup.id} headerGroup={headerGroup} />
                ))}
            </Thead>
            <Tbody>
                {table.getRowModel().rows.map((row) => (
                    <BodyRow<User> key={row.id} row={row} />
                ))}
            </Tbody>
            <Tfoot>
                {table.getFooterGroups().map((footerGroup) => (
                    <HeadRow<User> key={footerGroup.id} headerGroup={footerGroup} />
                ))}
            </Tfoot>
        </ChakraTable>
    );
}
