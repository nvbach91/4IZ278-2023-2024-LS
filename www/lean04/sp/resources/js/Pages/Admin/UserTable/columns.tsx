import { createColumnHelper } from '@tanstack/react-table';

import { User } from '@/types';

import { UserActionCell } from './cells';

const columnHelper = createColumnHelper<User>();

export const columns = [
    columnHelper.accessor('name', {
        cell: (info) => info.getValue(),
        header: 'Name',
    }),
    columnHelper.accessor('email', {
        cell: (info) => info.getValue(),
        header: 'Email',
    }),
    columnHelper.accessor('privilege', {
        cell: (info) => info.getValue(),
        header: 'Privilege level',
    }),
    columnHelper.display({
        cell: (info) => <UserActionCell user={info.row.original} />,
        header: 'Actions',
        enableSorting: false,
    }),
];
