import ActionCell from '@/Components/ActionCell';
import { useAuth } from '@/hooks/useAuth';
import { WithUser } from '@/types';

import { Delete } from './Delete';
import { Edit } from './Edit';

export const UserActionCell = ({ user }: WithUser) => {
    const auth = useAuth();
    return (
        <ActionCell align="start" isDisabled={auth.user.id === user.id}>
            <Edit user={user} />
            <Delete user={user} />
        </ActionCell>
    );
};
