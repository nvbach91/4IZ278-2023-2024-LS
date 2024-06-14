import { TriangleDownIcon, TriangleUpIcon } from '@chakra-ui/icons';
import { Th, Tr } from '@chakra-ui/react';
import { flexRender, HeaderGroup } from '@tanstack/react-table';

interface HeaderGroupProps<T> {
    headerGroup: HeaderGroup<T>;
}

export const HeadRow = <T,>({ headerGroup }: HeaderGroupProps<T>) => (
    <Tr key={headerGroup.id}>
        {headerGroup.headers.map((header, index) => (
            <Th
                key={header.id}
                onClick={header.column.getToggleSortingHandler()}
                px={0}
                pr={index !== headerGroup.headers.length - 1 ? 8 : 0}
            >
                {flexRender(header.column.columnDef.header, header.getContext())}
                {header.column.getIsSorted() ? (
                    header.column.getIsSorted() === 'desc' ? (
                        <TriangleDownIcon aria-label="sorted descending" ml={1} />
                    ) : (
                        <TriangleUpIcon aria-label="sorted ascending" ml={1} />
                    )
                ) : null}
            </Th>
        ))}
    </Tr>
);
