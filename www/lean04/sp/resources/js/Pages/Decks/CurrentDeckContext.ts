import { createContext } from 'react';

import { Deck } from '@/types';

export const CurrentDeckContext = createContext<Deck>({
    created_at: '',
    id: '',
    name: '',
    owner_id: '',
    updated_at: '',
    totalCardCount: 0,
});
