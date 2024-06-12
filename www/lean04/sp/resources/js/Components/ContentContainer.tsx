import { PropsWithChildren } from 'react';
import { Container, ContainerProps } from '@chakra-ui/react';

export const ContentContainer = ({ children, ...containerProps }: PropsWithChildren<ContainerProps>) => (
    <Container maxW="7xl" py={containerProps.py ?? 6} px={{ base: 4, sm: 5, lg: 8 }}>
        {children}
    </Container>
);
