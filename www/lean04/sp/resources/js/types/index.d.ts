import { Card as PokemonCard } from 'pokemon-tcg-sdk-typescript/dist/sdk';

export interface User {
    id: string;
    name: string;
    email: string;
    email_verified_at: string;
    privilege: number;
}

export interface WithUser {
    user: User;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};

export interface Deck {
    created_at: string;
    id: string;
    name: string;
    owner_id: string;
    updated_at: string;
}

export interface WithDeck {
    deck: Deck;
}

export interface WithPokemonCard {
    pokemonCard: PokemonCard;
}

export interface CountedPokemonCard extends PokemonCard {
    count: number;
}

export interface WithCountedPokemonCard {
    pokemonCard: CountedPokemonCard;
}

export interface WithPagination {
    page: number;
    limit: number;
    totalPages: number;
}

export interface WithSearchQuery {
    searchQuery: string;
}
