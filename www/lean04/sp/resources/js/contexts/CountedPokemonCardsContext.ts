import { createContext } from 'react';

import { CountedPokemonCard } from '@/types';

interface ContextValue {
    cards: Array<CountedPokemonCard>;
    setCards: React.Dispatch<React.SetStateAction<Array<CountedPokemonCard>>>;
}

const CountedPokemonCardsContext = createContext<ContextValue>({
    cards: [] as Array<CountedPokemonCard>,
    setCards: (
        // eslint-disable-next-line @typescript-eslint/no-unused-vars
        cards: Array<CountedPokemonCard> | ((prevCards: Array<CountedPokemonCard>) => Array<CountedPokemonCard>)
    ) => {},
});

export default CountedPokemonCardsContext;
