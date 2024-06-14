import { Td, Tr } from '@chakra-ui/react';
import { flexRender, Row } from '@tanstack/react-table';

interface BodyRowProps<T> {
    row: Row<T>;
}

export const BodyRow = <T,>({ row }: BodyRowProps<T>) => (
    <Tr key={row.id}>
        {row.getVisibleCells().map((cell, index) => (
            <Td key={`${row.id}-${cell.id}`} px={0} pr={index !== row.getVisibleCells().length - 1 ? 8 : 0}>
                {flexRender(cell.column.columnDef.cell, cell.getContext())}
            </Td>
        ))}
    </Tr>
);
