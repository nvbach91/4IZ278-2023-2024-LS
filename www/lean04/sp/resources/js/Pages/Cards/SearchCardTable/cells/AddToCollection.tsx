import { useState } from 'react';
import { PlusSquareIcon } from '@chakra-ui/icons';
import {
    Button,
    FormControl,
    FormHelperText,
    FormLabel,
    MenuItem,
    Modal,
    ModalBody,
    ModalCloseButton,
    ModalContent,
    ModalFooter,
    ModalHeader,
    ModalOverlay,
    NumberDecrementStepper,
    NumberIncrementStepper,
    NumberInput,
    NumberInputField,
    NumberInputStepper,
    useDisclosure,
    useToast,
} from '@chakra-ui/react';
import { useMutation } from '@tanstack/react-query';
import axios from 'axios';

import { WithPokemonCard } from '@/types';

export const AddToCollection = ({ pokemonCard }: WithPokemonCard) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const toast = useToast();

    const [count, setCount] = useState(1);

    const mutation = useMutation({
        mutationFn: async () =>
            axios.put(route('card.addToCollection'), {
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
                description: `${count}x ${pokemonCard.name} added to your collection.`,
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
                description: 'There was an error adding the card to your collection.',
                status: 'error',
                duration: 5000,
                isClosable: true,
                position: 'top-right',
            });
        },
    });

    return (
        <>
            <MenuItem icon={<PlusSquareIcon />} onClick={onOpen}>
                Add to Collection
            </MenuItem>
            <Modal isOpen={isOpen} onClose={onClose}>
                <ModalOverlay />
                <ModalContent>
                    <ModalHeader>Add to Collection</ModalHeader>
                    <ModalCloseButton />
                    <form
                        onSubmit={(event) => {
                            event.preventDefault();
                            mutation.mutate();
                        }}
                    >
                        <ModalBody>
                            <FormControl>
                                <FormLabel>Count</FormLabel>
                                <NumberInput
                                    defaultValue={1}
                                    min={1}
                                    value={count}
                                    onChange={(stringValue, numberValue) =>
                                        setCount(stringValue === '' ? 1 : numberValue)
                                    }
                                >
                                    <NumberInputField autoFocus />
                                    <NumberInputStepper>
                                        <NumberIncrementStepper />
                                        <NumberDecrementStepper />
                                    </NumberInputStepper>
                                </NumberInput>
                                <FormHelperText>Enter the number of cards to add to your collection.</FormHelperText>
                            </FormControl>
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
                </ModalContent>
            </Modal>
        </>
    );
};
