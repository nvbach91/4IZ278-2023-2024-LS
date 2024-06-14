import { Suspense } from 'react';
import { PlusSquareIcon } from '@chakra-ui/icons';
import {
    Center,
    MenuItem,
    Modal,
    ModalCloseButton,
    ModalContent,
    ModalHeader,
    ModalOverlay,
    Spinner,
    useDisclosure,
} from '@chakra-ui/react';

import ErrorBoundary from '@/Components/ErrorBoundary';
import { WithPokemonCard } from '@/types';

import { AddToDeckForm } from './AddToDeckForm';

export const AddToDeck = ({ pokemonCard }: WithPokemonCard) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    return (
        <>
            <MenuItem icon={<PlusSquareIcon />} onClick={onOpen}>
                Add to Deck
            </MenuItem>
            <Modal isOpen={isOpen} onClose={onClose}>
                <ModalOverlay />
                <ModalContent>
                    <ModalHeader>Add to Deck</ModalHeader>
                    <ModalCloseButton />
                    <ErrorBoundary>
                        <Suspense
                            fallback={
                                <Center p={8}>
                                    <Spinner />
                                </Center>
                            }
                        >
                            <AddToDeckForm pokemonCard={pokemonCard} onClose={onClose} />
                        </Suspense>
                    </ErrorBoundary>
                </ModalContent>
            </Modal>
        </>
    );
};
