import { FormEventHandler } from 'react';
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
import { WithUser } from '@/types';

export const Delete = ({ user }: WithUser) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const toast = useToast();

    const queryParams = useQueryParams();

    const { post, processing } = useForm();

    const handleSubmit: FormEventHandler = (event) => {
        event.preventDefault();
        post(route('user.delete', { id: user.id, ...queryParams }), {
            preserveState: false,
            onSuccess: () => {
                toast({
                    title: 'User deleted',
                    description: `${user.name} deleted.`,
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
                    description: `There was an error deleting ${user.name}.`,
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
                Delete
            </MenuItem>
            <Modal isOpen={isOpen} onClose={onClose}>
                <ModalOverlay />
                <ModalContent>
                    <form onSubmit={handleSubmit}>
                        <ModalHeader>Delete {user.name}</ModalHeader>
                        <ModalCloseButton />
                        <ModalBody>
                            Do you want to delete <strong>{user.name}</strong>?
                        </ModalBody>
                        <ModalFooter>
                            <Button variant="ghost" mr={3} onClick={onClose}>
                                Close
                            </Button>
                            <Button type="submit" isLoading={processing} colorScheme="red">
                                Delete
                            </Button>
                        </ModalFooter>
                    </form>
                </ModalContent>
            </Modal>
        </>
    );
};
