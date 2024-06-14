import React from 'react';
import { HStack, Text } from '@chakra-ui/react';

interface RenderPageProps {
    page: number;
    label: number | string;
    isDisabled: boolean;
}

interface PaginationProps {
    currentPage: number;
    totalPages: number;
    ellipsisLimit?: number;
    renderPage: (props: RenderPageProps) => React.ReactNode;
}

const Pagination: React.FC<PaginationProps> = ({ currentPage, totalPages, ellipsisLimit = 2, renderPage }) => {
    if (totalPages === 1) {
        return null;
    }

    const pages = [...Array(totalPages - 2).keys()]
        .map((page) => page + 2)
        .filter((page) => page >= currentPage - ellipsisLimit && page <= currentPage + ellipsisLimit);

    const startEllipsis = currentPage > ellipsisLimit + 1;
    const endEllipsis = currentPage < totalPages - ellipsisLimit;

    return (
        <HStack spacing={2}>
            {renderPage({
                page: currentPage - 1,
                label: 'Previous',
                isDisabled: currentPage === 1,
            })}
            {renderPage({
                page: 1,
                label: 1,
                isDisabled: currentPage === 1,
            })}
            {startEllipsis && <Text>...</Text>}
            {pages.map((page) =>
                renderPage({
                    page,
                    label: page,
                    isDisabled: currentPage === page,
                })
            )}
            {endEllipsis && <Text>...</Text>}
            {renderPage({
                page: totalPages,
                label: totalPages,
                isDisabled: currentPage === totalPages,
            })}
            {renderPage({
                page: currentPage + 1,
                label: 'Next',
                isDisabled: currentPage === totalPages,
            })}
        </HStack>
    );
};

export default Pagination;
