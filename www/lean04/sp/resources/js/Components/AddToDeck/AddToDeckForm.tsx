import { useState } from 'react';
import {
    Button,
    FormControl,
    FormHelperText,
    FormLabel,
    Link,
    ModalBody,
    ModalFooter,
    NumberDecrementStepper,
    NumberIncrementStepper,
    NumberInput,
    NumberInputField,
    NumberInputStepper,
    Select,
    Stack,
    Text,
    useToast,
} from '@chakra-ui/react';
import { Link as InertiaLink } from '@inertiajs/react';
import { useMutation, useSuspenseQuery } from '@tanstack/react-query';
import axios from 'axios';

import { Deck, WithPokemonCard } from '@/types';

interface AddToDeckFormProps extends WithPokemonCard {
    onClose: () => void;
}

export const AddToDeckForm = ({ pokemonCard, onClose }: AddToDeckFormProps) => {
    const toast = useToast();

    const { data: decks } = useSuspenseQuery({
        queryKey: ['deck.getOwnDecks'],
        queryFn: async () => axios.get<Array<Deck>>(route('deck.getOwnDecks')),
        select: (response) => response.data,
    });

    const [selectedDeckId, setSelectedDeckId] = useState(decks[0]?.id);
    const [count, setCount] = useState(1);

    const mutation = useMutation({
        mutationFn: async () =>
            axios.put(route('card.addToDeck'), {
                deck_id: selectedDeckId,

                count,
                card_id: pokemonCard.id,
                name: pokemonCard.name,
                supertype: pokemonCard.supertype,
                type: pokemonCard.types ? pokemonCard.types[0] ?? null : null,
                subtype: pokemonCard.subtypes ? pokemonCard.subtypes[0] ?? null : null,
                image_small_url: pokemonCard.images.small,
                image_large_url: pokemonCard.images.large,

                set_id: pokemonCard.set.id,
                set_name: pokemonCard.set.name,
                set_symbol_url: pokemonCard.set.images.symbol,
                set_logo_url: pokemonCard.set.images.logo,
            }),
        onSuccess: () => {
            toast({
                title: 'Card added to collection',
                description: `${count}x ${pokemonCard.name} added to ${decks.find(({ id }) => id === selectedDeckId)?.name ?? 'selected deck'}.`,
                status: 'success',
                duration: 5000,
                isClosable: true,
                position: 'top-right',
            });
            onClose();
        },
        onError: () => {
            toast({
                title: 'An error occurred',
                description: 'There was an error adding the card to your deck.',
                status: 'error',
                duration: 5000,
                isClosable: true,
                position: 'top-right',
            });
        },
    });

    return decks.length === 0 ? (
        <ModalBody>
            <Stack spacing={4}>
                <Text>
                    You don't have any decks yet. Click{' '}
                    <Link color="teal.500" as={InertiaLink} href={route('deck.add')}>
                        here
                    </Link>{' '}
                    to create a new deck.
                </Text>
            </Stack>
        </ModalBody>
    ) : (
        <form
            onSubmit={(event) => {
                event.preventDefault();
                mutation.mutate();
            }}
        >
            <ModalBody>
                <Stack spacing={4}>
                    <FormControl>
                        <FormLabel>Deck</FormLabel>
                        <Select
                            value={selectedDeckId}
                            onChange={(event) => {
                                setSelectedDeckId(event.target.value);
                            }}
                        >
                            {decks.map((deck) => (
                                <option key={deck.id} value={deck.id}>
                                    {deck.name}
                                </option>
                            ))}
                        </Select>
                        <FormHelperText>Select the deck to add you want to add the card to.</FormHelperText>
                    </FormControl>
                    <FormControl>
                        <FormLabel>Count</FormLabel>
                        <NumberInput
                            defaultValue={1}
                            min={1}
                            value={count}
                            onChange={(stringValue, numberValue) => setCount(stringValue === '' ? 1 : numberValue)}
                        >
                            <NumberInputField autoFocus />
                            <NumberInputStepper>
                                <NumberIncrementStepper />
                                <NumberDecrementStepper />
                            </NumberInputStepper>
                        </NumberInput>
                        <FormHelperText>Enter the number of cards to add to your selected deck.</FormHelperText>
                    </FormControl>
                </Stack>
            </ModalBody>
            <ModalFooter>
                <Button variant="ghost" mr={3} onClick={onClose}>
                    Close
                </Button>
                <Button type="submit" colorScheme="teal" isLoading={mutation.isPending}>
                    Add
                </Button>
            </ModalFooter>
        </form>
    );
};
