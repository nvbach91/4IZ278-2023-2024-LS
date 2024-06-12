import { PropsWithChildren, ReactNode } from 'react';
import { ChevronDownIcon } from '@chakra-ui/icons';
import { Box, Button, Flex, HStack, Menu, MenuButton, MenuItem, MenuList } from '@chakra-ui/react';
import { Link as InertiaLink } from '@inertiajs/react';

import ApplicationLogo from '@/Components/ApplicationLogo';
import { ContentContainer } from '@/Components/ContentContainer';
import NavLink from '@/Components/NavLink';
import { User } from '@/types';

export default function Authenticated({
    user,
    header,
    children,
}: PropsWithChildren<{ user: User; header?: ReactNode }>) {
    return (
        <Box minH="100vh" bg="gray.100">
            <Box as="nav" bg="white" borderBottomWidth={1} borderBottomColor="gray.100">
                <ContentContainer py={4}>
                    <Flex justifyContent="space-between">
                        <HStack spacing={6}>
                            <InertiaLink href={route('card.showOwn')}>
                                <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800" />
                            </InertiaLink>
                            <NavLink href={route('card.showOwn')} active={route().current('card.showOwn')}>
                                My collection
                            </NavLink>
                            <NavLink href={route('deck.showOwn')} active={route().current('deck.showOwn')}>
                                My decks
                            </NavLink>
                            <NavLink href={route('deck.showAll')} active={route().current('deck.showAll')}>
                                Explore decks
                            </NavLink>
                            <NavLink href={route('card.showSearch')} active={route().current('card.showSearch')}>
                                Search card
                            </NavLink>
                        </HStack>
                        <Menu>
                            <MenuButton as={Button} p={2} variant="link" rightIcon={<ChevronDownIcon />}>
                                {user.name}
                            </MenuButton>
                            <MenuList>
                                <MenuItem as={InertiaLink} href={route('profile.edit')}>
                                    Profile
                                </MenuItem>
                                <MenuItem as={InertiaLink} method="post" href={route('logout')}>
                                    Log Out
                                </MenuItem>
                            </MenuList>
                        </Menu>
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
