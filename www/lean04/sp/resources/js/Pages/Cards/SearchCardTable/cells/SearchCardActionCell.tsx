import AddToDeck from '@/Components/AddToDeck';
import { WithPokemonCard } from '@/types';

import ActionCell from '../../../../Components/ActionCell';

import { AddToCollection } from './AddToCollection';

export const SearchCardActionCell = ({ pokemonCard }: WithPokemonCard) => (
    <ActionCell>
        <AddToCollection pokemonCard={pokemonCard} />
        <AddToDeck pokemonCard={pokemonCard} />
    </ActionCell>
);
