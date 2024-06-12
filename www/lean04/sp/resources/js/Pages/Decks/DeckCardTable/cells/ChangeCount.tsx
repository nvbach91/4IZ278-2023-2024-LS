import { FormEventHandler, useContext } from 'react';
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
import { useForm } from '@inertiajs/react';

import { useQueryParams } from '@/hooks/useQueryParams';
import { WithCountedPokemonCard } from '@/types';

import { CurrentDeckContext } from '../../CurrentDeckContext';

export const ChangeCount = ({ pokemonCard }: WithCountedPokemonCard) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const toast = useToast();

    const deck = useContext(CurrentDeckContext);

    const { patch, data, setData, processing } = useForm({
        count: pokemonCard.count,
    });

    const queryParams = useQueryParams();

    const handleSubmit: FormEventHandler = (event) => {
        event.preventDefault();
        patch(route('card.changeDeckCount', { id: deck.id, deckId: deck.id, cardId: pokemonCard.id, ...queryParams }), {
            preserveState: false,
            onSuccess: () => {
                toast({
                    title: 'Count changed',
                    description: `${data.count}x ${pokemonCard.name} set to ${deck.name}.`,
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
                    description: `There was an error changing the count of ${pokemonCard.name} in ${deck.name}.`,
                    status: 'error',
                    duration: 5000,
                    isClosable: true,
                    position: 'top-right',
                });
            },
        });
    };

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
                    <form onSubmit={handleSubmit}>
                        <ModalBody>
                            <FormControl>
                                <FormLabel>Count</FormLabel>
                                <NumberInput
                                    defaultValue={1}
                                    min={1}
                                    value={data.count}
                                    onChange={(stringValue, numberValue) => {
                                        setData('count', stringValue === '' ? 1 : numberValue);
                                    }}
                                >
                                    <NumberInputField autoFocus />
                                    <NumberInputStepper>
                                        <NumberIncrementStepper />
                                        <NumberDecrementStepper />
                                    </NumberInputStepper>
                                </NumberInput>
                                <FormHelperText>
                                    Enter the number of {pokemonCard.name} you have in {deck.name}.
                                </FormHelperText>
                            </FormControl>
                        </ModalBody>
                        <ModalFooter>
                            <Button variant="ghost" mr={3} onClick={onClose}>
                                Close
                            </Button>
                            <Button type="submit" colorScheme="teal" isLoading={processing}>
                                Save
                            </Button>
                        </ModalFooter>
                    </form>
                </ModalContent>
            </Modal>
        </>
    );
};
