import { useContext, useState } from 'react';
import { ArrowUpDownIcon } from '@chakra-ui/icons';
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

import CountedPokemonCardsContext from '@/contexts/CountedPokemonCardsContext';
import { WithCountedPokemonCard } from '@/types';

export const ChangeCount = ({ pokemonCard }: WithCountedPokemonCard) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const toast = useToast();

    const { setCards } = useContext(CountedPokemonCardsContext);
    const [count, setCount] = useState(pokemonCard.count);

    const mutation = useMutation({
        mutationFn: async () =>
            axios.patch(route('card.changeCollectionCount'), {
                count,
                card_id: pokemonCard.id,
            }),
        onSuccess: () => {
            setCards((cards) => cards.map((card) => (card.id === pokemonCard.id ? { ...card, count } : card)));
            toast({
                title: 'Count changed',
                description: `${count}x ${pokemonCard.name} set to your collection.`,
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
                description: `There was an error changing the count of ${pokemonCard.name} in your collection.`,
                status: 'error',
                duration: 5000,
                isClosable: true,
                position: 'top-right',
            });
        },
    });

    return (
        <>
            <MenuItem icon={<ArrowUpDownIcon />} onClick={onOpen}>
                Change count
            </MenuItem>
            <Modal isOpen={isOpen} onClose={onClose}>
                <ModalOverlay />
                <ModalContent>
                    <ModalHeader>Change count</ModalHeader>
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
                                <FormHelperText>Enter the number of cards you have in your collection.</FormHelperText>
                            </FormControl>
                        </ModalBody>
                        <ModalFooter>
                            <Button variant="ghost" mr={3} onClick={onClose}>
                                Close
                            </Button>
                            <Button type="submit" colorScheme="teal" isLoading={mutation.isPending}>
                                Save
                            </Button>
                        </ModalFooter>
                    </form>
                </ModalContent>
            </Modal>
        </>
    );
};
