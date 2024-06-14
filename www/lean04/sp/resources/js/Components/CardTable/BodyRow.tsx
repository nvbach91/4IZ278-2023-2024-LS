import { Td, Tr } from '@chakra-ui/react';
import { flexRender, Row } from '@tanstack/react-table';
import { Card as PokemonCard } from 'pokemon-tcg-sdk-typescript/dist/sdk';

interface BodyRowProps {
    row: Row<PokemonCard>;
}

export const BodyRow = ({ row }: BodyRowProps) => (
    <Tr key={row.id}>
        {row.getVisibleCells().map((cell, index) => (
            <Td key={`${row.id}-${cell.id}`} px={0} pr={index !== row.getVisibleCells().length - 1 ? 8 : 0}>
                {flexRender(cell.column.columnDef.cell, cell.getContext())}
            </Td>
        ))}
    </Tr>
);
