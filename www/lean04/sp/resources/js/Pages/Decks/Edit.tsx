import { FormEventHandler } from 'react';
import {
    Box,
    Button,
    Card,
    CardBody,
    FormControl,
    FormErrorMessage,
    FormHelperText,
    FormLabel,
    Input,
    Stack,
    useToast,
} from '@chakra-ui/react';
import { Head, useForm } from '@inertiajs/react';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Deck, PageProps } from '@/types';

interface EditProps extends PageProps {
    deck: Deck;
}

export default function Edit({ auth, deck }: EditProps) {
    const { data, setData, put, errors, processing } = useForm({
        name: deck.name,
    });

    const toast = useToast();

    const handleSubmit: FormEventHandler = (event) => {
        event.preventDefault();
        put(route('deck.update', { id: deck.id }), {
            onSuccess: () => {
                toast({
                    title: 'Deck updated',
                    description: `Your deck "${data.name}" has been updated.`,
                    status: 'success',
                    duration: 5000,
                    isClosable: true,
                    position: 'top-right',
                });
            },
        });
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Edit deck</h2>}
        >
            <Head title="Edit deck" />

            <Card>
                <CardBody>
                    <form onSubmit={handleSubmit}>
                        <Stack spacing={8}>
                            <FormControl isRequired isInvalid={!!errors.name}>
                                <FormLabel>Deck name</FormLabel>
                                <Input
                                    type="name"
                                    value={data.name}
                                    onChange={(e) => setData('name', e.target.value)}
                                    autoFocus
                                />
                                {errors.name ? (
                                    <FormErrorMessage>{errors.name}</FormErrorMessage>
                                ) : (
                                    <FormHelperText>
                                        Enter a new unique and catchy name for your Pokémon deck.
                                    </FormHelperText>
                                )}
                            </FormControl>
                            <Box>
                                <Button type="submit" colorScheme="teal" isLoading={processing}>
                                    Edit deck
                                </Button>
                            </Box>
                        </Stack>
                    </form>
                </CardBody>
            </Card>
        </AuthenticatedLayout>
    );
}
