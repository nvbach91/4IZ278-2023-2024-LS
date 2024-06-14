import { Link, LinkProps } from '@chakra-ui/react';
import { InertiaLinkProps, Link as InertialLink } from '@inertiajs/react';

export default function NavLink({
    active = false,
    children,
    ...inertiaLinkProps
}: InertiaLinkProps & LinkProps & { active: boolean }) {
    return (
        <Link
            as={InertialLink}
            p={2}
            _hover={{
                bg: 'teal.50',
            }}
            {...(active
                ? {
                      borderBottom: 2,
                      borderStyle: 'solid',
                      borderColor: 'teal.500',
                  }
                : {})}
            {...inertiaLinkProps}
        >
            {children}
        </Link>
    );
}
