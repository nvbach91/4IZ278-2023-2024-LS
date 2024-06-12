import {
    Button,
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

import { WithDeck } from '@/types';

export const Delete = ({ deck }: WithDeck) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const toast = useToast();

    const mutation = useMutation({
        mutationFn: async () => axios.delete(route('deck.delete', { id: deck.id })),
        onSuccess: () => {
            onClose();
            const promise = new Promise<void>((resolve) => {
                setTimeout(() => {
                    window.location.href = route('deck.showOwn');
                    resolve();
                }, 2000);
            });
            toast.promise(promise, {
                loading: {
                    title: `Deck deleted`,
                    description: `${deck.name} has been deleted. You will be redirected to your deck list shortly.`,
                    isClosable: true,
                    position: 'top-right',
                    colorScheme: 'green',
                },
                success: {
                    title: 'Redirecting to your deck list',
                    isClosable: true,
                    position: 'top-right',
                    colorScheme: 'blue',
                },
                error: {
                    title: 'An error occurred',
                    description: `There was an error deleting ${deck.name}`,
                    isClosable: true,
                    position: 'top-right',
                },
            });
        },
        onError: () => {
            toast({
                title: 'An error occurred',
                description: `There was an error deleting ${deck.name}`,
                status: 'error',
                duration: 5000,
                isClosable: true,
                position: 'top-right',
            });
        },
    });

    return (
        <>
            <Button colorScheme="red" leftIcon={<FaTrash />} onClick={onOpen}>
                Delete
            </Button>
            <Modal isOpen={isOpen} onClose={onClose}>
                <ModalOverlay />
                <ModalContent>
                    <ModalHeader>Delete {deck.name}</ModalHeader>
                    <ModalCloseButton />
                    <ModalBody>Do you want to delete {deck.name}?</ModalBody>
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
                            Delete
                        </Button>
                    </ModalFooter>
                </ModalContent>
            </Modal>
        </>
    );
};
