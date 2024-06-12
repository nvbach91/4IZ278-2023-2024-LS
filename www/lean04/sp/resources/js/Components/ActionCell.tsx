import { PropsWithChildren } from 'react';
import { Flex, IconButton, Menu, MenuButton, MenuList } from '@chakra-ui/react';
import { BsThreeDotsVertical } from 'react-icons/bs';

export default function ActionCell({ children }: PropsWithChildren) {
    return (
        <Flex justifyContent="center">
            <Menu>
                <MenuButton as={IconButton} icon={<BsThreeDotsVertical />} size="sm">
                    Action
                </MenuButton>
                <MenuList>{children}</MenuList>
            </Menu>
        </Flex>
    );
}
