import { SearchIcon } from '@chakra-ui/icons';
import { HStack, IconButton, Input } from '@chakra-ui/react';
import { Link as InertiaLink } from '@inertiajs/react';

interface SearchInputProps {
    autoFocus?: boolean;
    defaultValue?: string;
    action: string;
}

const SearchInput = ({ autoFocus, defaultValue, action }: SearchInputProps) => (
    <form method="get" action={action}>
        <HStack spacing={0}>
            <Input
                autoFocus={autoFocus}
                defaultValue={defaultValue}
                type="text"
                name="searchQuery"
                placeholder="Search..."
                size="sm"
                borderLeftRadius="md"
                borderRightRadius="none"
            />
            <IconButton
                aria-label="search"
                as={InertiaLink}
                href="#"
                icon={<SearchIcon />}
                size="sm"
                borderLeftRadius="none"
            />
        </HStack>
    </form>
);

export default SearchInput;
