import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import GeneralLayout from "@/Layouts/GeneralLayout.jsx";
import SubjectCard from "@/Components/Cards/SubjectCard.jsx";
import {Head} from "@inertiajs/react";
import {useState} from "react";
import {Inertia} from "@inertiajs/inertia";
import SearchInput from "@/Components/SearchInput.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import UnderlinedButton from "@/Components/UnderlinedButton.jsx";
import Pagination from "@/Components/Pagination.jsx";
import LinkButton from "@/Components/LinkButton.jsx";
import LinkUnderlined from "@/Components/LinkUnderlined.jsx";

export default function Index({university, subjects, query, auth, canUpdate}) {
    const isAuthenticated = auth && auth.user

    return (
        isAuthenticated ? (
            <AuthenticatedLayout
                user={auth.user}
                // header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
            >
                <Head title={university?.name}/>
                <div className="py-12">
                    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <UniversityContent university={university} subjects={subjects} query={query}
                                               canUpdate={canUpdate}/>
                        </div>
                    </div>
                </div>
            </AuthenticatedLayout>
        ) : (
            <GeneralLayout title={university.name} auth={auth}>
                <UniversityContent university={university} subjects={subjects} query={query} canUpdate={false}/>
            </GeneralLayout>)
    )
}

function UniversityContent({university, subjects, query, canUpdate}) {
    const [searchQuery, setSearchQuery] = useState(query || '');

    const handleSearch = (e) => {
        e.preventDefault();
        Inertia.get(route('universities.show', university.id), {query: searchQuery}, {
            preserveState: true,
            replace: true,
        });
    };
    return (
        <section className="flex flex-col items-center">
            <h1 className="font-bold text-3xl">{university.name}</h1>
            <p className="mt-3 text-lg text-gray-600">{university.location}</p>
            {canUpdate && (
                <div className="mt-3">
                    <LinkUnderlined url={`/universities/${university.id}/edit`}>
                        Edit university
                    </LinkUnderlined>
                </div>

            )}
            <form onSubmit={handleSearch} className="flex justify-center items-center my-6 w-full">
                <SearchInput query={searchQuery} setQuery={setSearchQuery}
                             placeholder="Search for subject..."/>
                <PrimaryButton type="submit" className="ml-3 ">
                    Search
                </PrimaryButton>
                {query?.length > 0 && (
                    <UnderlinedButton onClick={() => setSearchQuery('')} className="ml-3">
                        Clear
                    </UnderlinedButton>
                )}
            </form>
            <div className="w-full">
                {subjects?.data?.length > 0 ? (
                    <>
                        <div className="flex justify-center w-full">
                            <LinkButton href={route('subjects.create')}>
                                Add new subject
                            </LinkButton>
                        </div>
                        <div className="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mt-8">
                            {subjects?.data?.map(subject => (
                                <SubjectCard key={subject.id} subject={subject}/>
                            ))}
                        </div>
                    </>
                ) : (
                    <div className="flex flex-col justify-center items-center gap-y-5 py-6">
                        <img src="/images/nothing-found.svg" alt="No subjects found"
                             className="h-[200px]"/>
                        <p className="font-bold text-lg text-center w-full">No subjects found.</p>
                        <LinkButton href={route('subjects.create')}>
                            Add subject
                        </LinkButton>
                    </div>
                )}
            </div>

            <Pagination links={subjects.links}/>
        </section>
    );
}
