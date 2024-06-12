import { Center, Icon, Image, Tooltip } from '@chakra-ui/react';
import { createColumnHelper } from '@tanstack/react-table';
import { Card as PokemonCard } from 'pokemon-tcg-sdk-typescript/dist/sdk';
import { MdOutlineCameraAlt } from 'react-icons/md';

const columnHelper = createColumnHelper<PokemonCard>();

export const columns = [
    columnHelper.accessor('images.small', {
        cell: (info) => {
            const imgUrl = info.getValue();
            return (
                <Tooltip hasArrow label={<Image src={imgUrl} />} bg="transparent" color="black">
                    <Center>
                        <Icon as={MdOutlineCameraAlt} boxSize={6} />
                    </Center>
                </Tooltip>
            );
        },
        header: '',
        enableSorting: false,
    }),
    columnHelper.accessor('name', {
        cell: (info) => info.getValue(),
        header: 'Name',
    }),
    columnHelper.accessor('supertype', {
        cell: (info) => info.getValue(),
        header: 'Supertype',
    }),
    columnHelper.accessor('types', {
        cell: (info) => info.getValue()?.join(', '),
        header: 'Type',
    }),
    columnHelper.accessor('subtypes', {
        cell: (info) => info.getValue()?.join('\n'),
        header: 'Subtype',
    }),
    columnHelper.accessor('set', {
        cell: (info) => info.getValue().name,
        header: 'Set',
    }),
];
