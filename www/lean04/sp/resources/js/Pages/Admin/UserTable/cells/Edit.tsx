import { FormEventHandler } from 'react';
import { EditIcon } from '@chakra-ui/icons';
import {
    Button,
    FormControl,
    FormHelperText,
    FormLabel,
    Input,
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
    Stack,
    useDisclosure,
    useToast,
} from '@chakra-ui/react';
import { useForm } from '@inertiajs/react';

import { useQueryParams } from '@/hooks/useQueryParams';
import { WithUser } from '@/types';

export const Edit = ({ user }: WithUser) => {
    const { isOpen, onOpen, onClose } = useDisclosure();
    const toast = useToast();

    const { post, data, setData, processing } = useForm({
        name: user.name,
        email: user.email,
        privilege: user.privilege,
    });

    const queryParams = useQueryParams();

    const handleSubmit: FormEventHandler = (event) => {
        event.preventDefault();
        post(route('user.update', { id: user.id, ...queryParams }), {
            preserveState: false,
            onSuccess: () => {
                toast({
                    title: 'User updated',
                    description: `${data.name} updated.`,
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
                    description: `There was an error updating ${data.name}.`,
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
            <MenuItem icon={<EditIcon />} onClick={onOpen}>
                Edit
            </MenuItem>
            <Modal isOpen={isOpen} onClose={onClose}>
                <ModalOverlay />
                <ModalContent>
                    <ModalHeader>Edit user</ModalHeader>
                    <ModalCloseButton />
                    <form onSubmit={handleSubmit}>
                        <ModalBody>
                            <Stack spacing={4}>
                                <FormControl isRequired>
                                    <FormLabel>Name</FormLabel>
                                    <Input
                                        value={data.name}
                                        onChange={(event) => {
                                            setData('name', event.target.value);
                                        }}
                                    />
                                    <FormHelperText></FormHelperText>
                                </FormControl>
                                <FormControl isRequired>
                                    <FormLabel>Email</FormLabel>
                                    <Input
                                        value={data.email}
                                        onChange={(event) => {
                                            setData('email', event.target.value);
                                        }}
                                    />
                                    <FormHelperText></FormHelperText>
                                </FormControl>
                                <FormControl>
                                    <FormLabel>Privilege</FormLabel>
                                    <NumberInput
                                        defaultValue={0}
                                        min={0}
                                        max={2}
                                        value={data.privilege}
                                        onChange={(stringValue, numberValue) => {
                                            setData('privilege', stringValue === '' ? 1 : numberValue);
                                        }}
                                    >
                                        <NumberInputField autoFocus />
                                        <NumberInputStepper>
                                            <NumberIncrementStepper />
                                            <NumberDecrementStepper />
                                        </NumberInputStepper>
                                    </NumberInput>
                                    <FormHelperText>Set privilege level of user.</FormHelperText>
                                </FormControl>
                            </Stack>
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
