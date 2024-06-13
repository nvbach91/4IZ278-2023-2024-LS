import { FormEventHandler, useContext } from 'react';
import {
    Button,
    MenuItem,
    Modal,
    ModalBody,
    ModalCloseButton,
    ModalContent,
    ModalFooter,
    ModalHeader,
    ModalOverlay,
    useDisclosure,
    useToast,
} from '@chakra-ui/react';
import { useForm } from '@inertiajs/react';
import { FaTrash } from 'react-icons/fa6';

import { useQueryParams } from '@/hooks/useQueryParams';
import { WithCountedPokemonCard } from '@/types';

import { CurrentDeckContext } from '../../CurrentDeckContext';

export const Remove = ({ pokemonCard }: WithCountedPokemonCard) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const toast = useToast();

    const deck = useContext(CurrentDeckContext);

    const queryParams = useQueryParams();

    const { post, processing } = useForm();

    const handleSubmit: FormEventHandler = (event) => {
        event.preventDefault();
        post(route('card.removeFromDeck', { id: deck.id, deckId: deck.id, cardId: pokemonCard.id, ...queryParams }), {
            preserveState: false,
            onSuccess: () => {
                toast({
                    title: `Card removed from ${deck.name}`,
                    description: `${pokemonCard.name} removed from your ${deck.name}.`,
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
                    description: `There was an error removing ${pokemonCard.name} from ${deck.name}`,
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
            <MenuItem icon={<FaTrash />} onClick={onOpen}>
                Remove
            </MenuItem>
            <Modal isOpen={isOpen} onClose={onClose}>
                <ModalOverlay />
                <ModalContent>
                    <form onSubmit={handleSubmit}>
                        <ModalHeader>Remove {pokemonCard.name}</ModalHeader>
                        <ModalCloseButton />
                        <ModalBody>
                            Do you want to remove <strong>{pokemonCard.name}</strong> from {deck.name}?
                        </ModalBody>
                        <ModalFooter>
                            <Button variant="ghost" mr={3} onClick={onClose}>
                                Close
                            </Button>
                            <Button type="submit" isLoading={processing} colorScheme="red">
                                Remove
                            </Button>
                        </ModalFooter>
                    </form>
                </ModalContent>
            </Modal>
        </>
    );
};
