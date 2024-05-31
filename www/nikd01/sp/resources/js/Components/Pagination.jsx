import React from 'react';
import {InertiaLink} from '@inertiajs/inertia-react';

export default function Pagination({links}) {
    if (links.length === 3) {
        // Only one page, no need to show pagination
        return null;
    }

    return (
        <nav className="flex justify-center mt-8">
            <ul className="inline-flex items-center space-x-3">
                {links.map((link, index) => {
                    if (index === 0 && !link.url) return null; // Hide "previous" on the first page
                    if (index === links.length - 1 && !link.url) return null; // Hide "next" on the last page

                    return (
                        <li key={index}>
                            <InertiaLink
                                href={link.url}
                                className={`px-3 py-2 leading-tight border rounded transition duration-150 ease-in-out ${link.active ? 'bg-blue-800 text-white border-blue-800 pointer-events-none' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-100 hover:text-gray-700'}`}
                                dangerouslySetInnerHTML={{__html: link.label}}
                            />
                        </li>
                    );
                })}
            </ul>
        </nav>
    );
};
