import { FormEventHandler, Suspense, useState } from 'react';
import {
    Box,
    Button,
    Card,
    CardBody,
    Center,
    FormControl,
    FormHelperText,
    FormLabel,
    Input,
    Spinner,
    Stack,
} from '@chakra-ui/react';
import { Head } from '@inertiajs/react';

import ErrorBoundary from '@/Components/ErrorBoundary';
import SharedLayout from '@/Layouts/SharedLayout';
import { PageProps } from '@/types';

import SearchCardTable from './SearchCardTable';

export default function Search({ auth }: PageProps) {
    const [nameInputValue, setNameInputValue] = useState('');
    const [searchValue, setSearchValue] = useState<string>();

    const handleSubmit: FormEventHandler<HTMLFormElement> = (event) => {
        event.preventDefault();
        setSearchValue(nameInputValue.trim());
    };

    return (
        <SharedLayout
            auth={auth}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Search card</h2>}
        >
            <Head title="Search card" />
            <Stack spacing={6}>
                <Card>
                    <CardBody>
                        <form onSubmit={handleSubmit}>
                            <Stack spacing={8}>
                                <FormControl isRequired>
                                    <FormLabel>Search Card by Name:</FormLabel>
                                    <Input
                                        type="name"
                                        value={nameInputValue}
                                        onChange={(event) => setNameInputValue(event.target.value)}
                                        autoFocus
                                    />
                                    <FormHelperText>
                                        Enter the full or partial name of the card you're looking for.
                                    </FormHelperText>
                                </FormControl>
                                <Box>
                                    <Button type="submit" colorScheme="teal">
                                        Search card
                                    </Button>
                                </Box>
                            </Stack>
                        </form>
                    </CardBody>
                </Card>
                {searchValue ? (
                    <Card>
                        <CardBody>
                            <ErrorBoundary>
                                <Suspense
                                    fallback={
                                        <Center>
                                            <Spinner />
                                        </Center>
                                    }
                                >
                                    <SearchCardTable searchValue={searchValue} />
                                </Suspense>
                            </ErrorBoundary>
                        </CardBody>
                    </Card>
                ) : null}
            </Stack>
        </SharedLayout>
    );
}
