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
import { PageProps } from '@/types';

export default function Add({ auth }: PageProps) {
    const { data, setData, post, errors, processing } = useForm({
        owner_id: auth.user.id,
        name: '',
    });

    const toast = useToast();

    const handleSubmit: FormEventHandler = (event) => {
        event.preventDefault();
        post(route('deck.create'), {
            onSuccess: () => {
                toast({
                    title: 'Deck created',
                    description: `Your new deck "${data.name}" has been created.`,
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
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Add new deck</h2>}
        >
            <Head title="Add new deck" />

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
                                        Enter a unique and catchy name for your Pokémon deck.
                                    </FormHelperText>
                                )}
                            </FormControl>
                            <Box>
                                <Button type="submit" colorScheme="teal" isLoading={processing}>
                                    Create deck
                                </Button>
                            </Box>
                        </Stack>
                    </form>
                </CardBody>
            </Card>
        </AuthenticatedLayout>
    );
}
