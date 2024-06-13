import { PropsWithChildren } from 'react';
import { Flex, IconButton, Menu, MenuButton, MenuList } from '@chakra-ui/react';
import { BsThreeDotsVertical } from 'react-icons/bs';

interface ActionCellProps {
    align?: 'start' | 'center' | 'end';
    isDisabled?: boolean;
}

export default function ActionCell({ children, align = 'center', isDisabled }: PropsWithChildren<ActionCellProps>) {
    return (
        <Flex justifyContent={align}>
            <Menu>
                <MenuButton as={IconButton} icon={<BsThreeDotsVertical />} size="sm" isDisabled={isDisabled}>
                    Action
                </MenuButton>
                <MenuList>{children}</MenuList>
            </Menu>
        </Flex>
    );
}
