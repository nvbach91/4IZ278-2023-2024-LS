import {
    Accordion,
    AccordionButton,
    AccordionIcon,
    AccordionItem,
    AccordionPanel,
    Card,
    CardBody,
    CardHeader,
    Flex,
    Heading,
} from '@chakra-ui/react';

import CardTable from '@/Components/CardTable';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { countColumn } from '@/shared/columns/countColumn';
import { CountedPokemonCard, PageProps } from '@/types';

interface StatisticsProps extends PageProps {
    mostOwnedCardsInCollections: Array<CountedPokemonCard>;
    mostUsedCardsInDecks: Array<CountedPokemonCard>;
}

export default function Statistics({ auth, mostOwnedCardsInCollections, mostUsedCardsInDecks }: StatisticsProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Statistics</h2>}
        >
            <Card>
                <CardHeader>
                    <Heading size="md">Card usage</Heading>
                </CardHeader>
                <CardBody>
                    <Accordion allowMultiple>
                        <AccordionItem>
                            <AccordionButton>
                                <Flex justifyContent="space-between" w="100%">
                                    <Heading size="sm">Most owned in collections</Heading>
                                    <AccordionIcon />
                                </Flex>
                            </AccordionButton>
                            <AccordionPanel>
                                <CardTable data={mostOwnedCardsInCollections} additionalColumns={[countColumn]} />
                            </AccordionPanel>
                        </AccordionItem>
                        <AccordionItem>
                            <AccordionButton>
                                <Flex justifyContent="space-between" w="100%">
                                    <Heading size="sm">Most used in decks</Heading>
                                    <AccordionIcon />
                                </Flex>
                            </AccordionButton>
                            <AccordionPanel>
                                <CardTable data={mostUsedCardsInDecks} additionalColumns={[countColumn]} />
                            </AccordionPanel>
                        </AccordionItem>
                    </Accordion>
                </CardBody>
            </Card>
        </AuthenticatedLayout>
    );
}
