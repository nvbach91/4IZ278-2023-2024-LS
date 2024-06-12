import { PropsWithChildren, ReactNode } from 'react';
import { Box, Button, Flex, HStack } from '@chakra-ui/react';
import { Link as InertiaLink } from '@inertiajs/react';

import ApplicationLogo from '@/Components/ApplicationLogo';
import { ContentContainer } from '@/Components/ContentContainer';
import NavLink from '@/Components/NavLink';

export default function Guest({ header, children }: PropsWithChildren<{ header?: ReactNode }>) {
    return (
        <Box minH="100vh" bg="gray.100">
            <Box as="nav" bg="white" borderBottomWidth={1} borderBottomColor="gray.100">
                <ContentContainer py={4}>
                    <Flex justifyContent="space-between">
                        <HStack spacing={6}>
                            <InertiaLink href="/">
                                <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800" />
                            </InertiaLink>
                            <NavLink href={route('deck.showAll')} active={route().current('deck.showAll')}>
                                Explore decks
                            </NavLink>
                            <NavLink href={route('card.showSearch')} active={route().current('card.showSearch')}>
                                Search card
                            </NavLink>
                        </HStack>

                        <HStack spacing={4}>
                            <Button variant="link" as={InertiaLink} href={route('login')}>
                                Login
                            </Button>
                            <Button variant="link" as={InertiaLink} href={route('register')}>
                                Register
                            </Button>
                        </HStack>
                    </Flex>
                </ContentContainer>
            </Box>

            {header && (
                <Box as="header" bg="white" boxShadow="sm">
                    <ContentContainer>{header}</ContentContainer>
                </Box>
            )}

            <main>
                <ContentContainer>{children}</ContentContainer>
            </main>
        </Box>
    );
}
