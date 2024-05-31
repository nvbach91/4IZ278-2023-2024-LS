import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head} from '@inertiajs/react';
import LinkButton from "@/Components/LinkButton.jsx";
import MaterialCard from "@/Components/Cards/MaterialCard.jsx";

export default function Dashboard({auth, materials, latestMaterials}) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            // header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="My Materials"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 pt-6 pb-12">
                        <h1 className="text-3xl font-bold text-center">My Materials</h1>

                        {materials?.length > 0 ? (
                            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                                {materials.map((material) => (
                                    <MaterialCard key={material.id} material={material} isAuthenticated/>
                                ))}
                            </div>) : (
                            <div className="w-full flex flex-col justify-center mt-8">
                                <img src="/images/nothing-found.svg" alt="Nothing found"
                                     className="h-[150px]"/>
                                <p className="text-center mt-6 font-semibold text-lg">You have not uploaded any
                                    materials
                                    yet</p>
                            </div>
                        )}

                        <div className="mt-8 w-full flex justify-center">
                            <LinkButton href="/materials/create">
                                Add new material
                            </LinkButton>
                        </div>
                    </div>
                    {latestMaterials?.length > 0 && (
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 pt-6 pb-12 mt-10">
                            <h1 className="text-3xl font-bold text-center">Latest materials</h1>

                            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                                {latestMaterials?.map((material) => (
                                    <MaterialCard key={material.id} material={material} isAuthenticated/>
                                ))}
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
