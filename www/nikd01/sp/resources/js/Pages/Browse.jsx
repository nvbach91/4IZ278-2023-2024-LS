import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head} from '@inertiajs/react';
import UniversityCard from "@/Components/Cards/UniversityCard.jsx";
import SearchInput from "@/Components/SearchInput.jsx"
import {Inertia} from '@inertiajs/inertia';
import {useState} from "react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import Pagination from "@/Components/Pagination.jsx";
import UnderlinedButton from "@/Components/UnderlinedButton.jsx";
import LinkButton from "@/Components/LinkButton.jsx";

export default function Browse({auth, universities, query}) {
    const [searchQuery, setSearchQuery] = useState(query || '');

    const handleSearch = (e) => {
        e.preventDefault();
        Inertia.visit(route('browse'), {
            method: 'get',
            data: {query: searchQuery},
            preserveState: true,
            replace: true
        });
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            // header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Browse"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h1 className="text-3xl font-bold text-center">Browse materials by universities</h1>
                        <form onSubmit={handleSearch} className="flex justify-center items-center my-6">
                            <SearchInput query={searchQuery} setQuery={setSearchQuery}
                                         placeholder="Search for university..."/>
                            <PrimaryButton type="submit" className="ml-3 ">
                                Search
                            </PrimaryButton>
                            {query?.length > 0 && (
                                <UnderlinedButton onClick={() => setSearchQuery('')} className="ml-3">
                                    Clear
                                </UnderlinedButton>
                            )}
                        </form>
                        {universities?.data?.length > 0 ? (
                            <div className="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mt-8">
                                {universities?.data?.map((university) => (
                                    <UniversityCard key={university.id} university={university}/>
                                ))}
                            </div>
                        ) : (
                            <div className="flex flex-col justify-center items-center gap-y-5 py-6">
                                <img src="/images/nothing-found.svg" alt="No universities found"
                                     className="h-[200px]"/>
                                <p className="font-bold text-lg text-center w-full">No universities found.</p>
                                <LinkButton href={route('universities.create')} className="mt-3">
                                    Add university
                                </LinkButton>
                            </div>
                        )}

                        <Pagination links={universities.links}/>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
