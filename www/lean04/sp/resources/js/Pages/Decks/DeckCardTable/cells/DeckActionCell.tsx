import ActionCell from '@/Components/ActionCell';
import { WithCountedPokemonCard } from '@/types';

import { ChangeCount } from './ChangeCount';
import { Remove } from './Remove';

export const DeckActionCell = ({ pokemonCard }: WithCountedPokemonCard) => (
    <ActionCell>
        <ChangeCount pokemonCard={pokemonCard} />
        <Remove pokemonCard={pokemonCard} />
    </ActionCell>
);
