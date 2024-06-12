import { Button, Center, Heading, Text, VStack } from '@chakra-ui/react';
import { Head, Link as InertiaLink } from '@inertiajs/react';

import SharedLayout from '@/Layouts/SharedLayout';
import { PageProps } from '@/types';

export default function Welcome({
    auth,
    laravelVersion,
    phpVersion,
}: PageProps<{ laravelVersion: string; phpVersion: string }>) {
    return (
        <SharedLayout auth={auth}>
            <Head title="Welcome" />

            <VStack h="100%" mt={48}>
                <Center flexGrow={1}>
                    <VStack spacing={8}>
                        <Heading as="h1" size="4xl">
                            Welcome to PalPad
                        </Heading>
                        <Text fontSize="2xl">Your ultimate app for managing Pokemon TCG decks and collections!</Text>
                        <Button
                            as={InertiaLink}
                            href={route('register')}
                            colorScheme="teal"
                            rounded="full"
                            boxShadow="xl"
                            size="lg"
                        >
                            Get started
                        </Button>
                    </VStack>
                </Center>

                <div className="flex justify-center mt-16 sm:items-center sm:justify-between">
                    <div className="text-center text-sm sm:text-start">&nbsp;</div>

                    <div className="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-end sm:ms-0">
                        Laravel v{laravelVersion} (PHP v{phpVersion})
                    </div>
                </div>
            </VStack>
        </SharedLayout>
    );
}
