import ActionCell from '@/Components/ActionCell';
import AddToDeck from '@/Components/AddToDeck';
import { WithCountedPokemonCard } from '@/types';

import { ChangeCount } from './ChangeCount';
import { Remove } from './Remove';

export const CollectionActionCell = ({ pokemonCard }: WithCountedPokemonCard) => (
    <ActionCell>
        <ChangeCount pokemonCard={pokemonCard} />
        <AddToDeck pokemonCard={pokemonCard} />
        <Remove pokemonCard={pokemonCard} />
    </ActionCell>
);
