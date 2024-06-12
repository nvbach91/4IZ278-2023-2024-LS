import { useContext } from 'react';
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
import { useMutation } from '@tanstack/react-query';
import axios from 'axios';
import { FaTrash } from 'react-icons/fa6';

import CountedPokemonCardsContext from '@/contexts/CountedPokemonCardsContext';
import { WithCountedPokemonCard } from '@/types';

export const Remove = ({ pokemonCard }: WithCountedPokemonCard) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const toast = useToast();

    const { setCards } = useContext(CountedPokemonCardsContext);

    const mutation = useMutation({
        mutationFn: async () =>
            axios.patch(route('card.removeFromCollection'), {
                card_id: pokemonCard.id,
            }),
        onSuccess: () => {
            setCards((cards) => cards.filter((card) => card.id !== pokemonCard.id));
            toast({
                title: 'Card removed from collection',
                description: `${pokemonCard.name} removed from your collection.`,
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
                description: `There was an error removing ${pokemonCard.name} from your collection.`,
                status: 'error',
                duration: 5000,
                isClosable: true,
                position: 'top-right',
            });
        },
    });

    return (
        <>
            <MenuItem icon={<FaTrash />} onClick={onOpen}>
                Remove
            </MenuItem>
            <Modal isOpen={isOpen} onClose={onClose}>
                <ModalOverlay />
                <ModalContent>
                    <ModalHeader>Remove {pokemonCard.name}</ModalHeader>
                    <ModalCloseButton />
                    <ModalBody>
                        Do you want to remove <strong>{pokemonCard.name}</strong> from your collection?
                    </ModalBody>
                    <ModalFooter>
                        <Button variant="ghost" mr={3} onClick={onClose}>
                            Close
                        </Button>
                        <Button
                            onClick={() => {
                                mutation.mutate();
                            }}
                            isLoading={mutation.isPending}
                            colorScheme="red"
                        >
                            Remove
                        </Button>
                    </ModalFooter>
                </ModalContent>
            </Modal>
        </>
    );
};
