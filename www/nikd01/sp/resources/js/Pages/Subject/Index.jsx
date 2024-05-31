import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import GeneralLayout from "@/Layouts/GeneralLayout.jsx";
import MaterialCard from "@/Components/Cards/MaterialCard.jsx";
import {Head} from "@inertiajs/react";
import LinkButton from "@/Components/LinkButton.jsx";

export default function Index({subject, auth}) {
    const isAuthenticated = auth && auth.user;

    return (
        isAuthenticated ? (
            <AuthenticatedLayout
                user={auth.user}
                // header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
            >
                <Head title={subject?.name}/>
                <div className="py-12">
                    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <SubjectContent subject={subject} isAuthenticated/>
                        </div>
                    </div>
                </div>
            </AuthenticatedLayout>
        ) : (
            <GeneralLayout title={subject.name} auth={auth}>
                <SubjectContent subject={subject}/>
            </GeneralLayout>
        )
    )
}

function SubjectContent({subject, isAuthenticated = false}) {
    const {materials, name, description} = subject || {};
    return (
        <section className="flex flex-col items-center">
            <h1 className="font-bold text-3xl">{name}</h1>
            <h2 className="text-black/80 text-lg mt-4 max-w-xl text-center">{description}</h2>
            <div className="mt-4">
                <LinkButton href={`/materials/create?subject=${subject?.id}`}>
                    Add new material
                </LinkButton>
            </div>
            {materials?.length > 0 ? (
                <div className="grid md:grid-cols-2 xl:grid-cols-3 gap-6 mt-8">
                    {materials?.map(material => (
                        <MaterialCard key={material.id} material={material} isAuthenticated={isAuthenticated}/>
                    ))}
                </div>
            ) : (
                <div className="flex flex-col justify-center items-center gap-y-4 py-8">
                    <img src="/images/nothing-found.svg" alt="No materials found"
                         className="h-[200px]"/>
                    <p className="font-bold text-lg text-center w-full">No materials found.</p>
                    <LinkButton href={route('materials.create')}>
                        Add material
                    </LinkButton>
                </div>
            )}
        </section>
    );
}
