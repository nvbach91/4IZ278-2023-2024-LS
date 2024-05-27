import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import React, {useEffect} from "react";
import {Head, useForm} from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel.jsx";
import InputError from "@/Components/InputError.jsx";
import TextInput from "@/Components/TextInput.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function Create({auth, universities}) {
    const {data, setData, post, processing, errors, reset} = useForm({
        name: '',
        code: '',
        description: '',
        university_id: 0
    });

    useEffect(() => {
        return () => {
            reset('name', 'code', 'description', 'university_id');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('subjects.store'), {
            forceFormData: true,
            onSuccess: () => console.log('success'),
        });
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            // header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Add New University"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div
                        className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h1 className="text-3xl font-bold text-center">Add New Subject</h1>
                        <form onSubmit={submit} className="mt-4 flex flex-col items-center w-full">
                            <div className="w-full max-w-lg">
                                <InputLabel htmlFor="University" value="University"/>

                                <select
                                    id="university"
                                    name="university"
                                    className="mt-1 block w-full rounded-md border-gray-300"
                                    onChange={(e) => setData('university_id', e.target.value)}
                                >
                                    <option value={0}>Select university</option>
                                    {universities.map((university) => (
                                        <option key={university.id} value={university.id}>{university.name}</option>
                                    ))}
                                </select>

                                <InputError message={errors.university_id} className="mt-2"/>
                            </div>

                            <div className="mt-4 w-full max-w-lg">
                                <InputLabel htmlFor="name" value="Name"/>

                                <TextInput
                                    id="name"
                                    type="text"
                                    name="name"
                                    value={data.name}
                                    className="mt-1 block w-full"
                                    isFocused={true}
                                    onChange={(e) => setData('name', e.target.value)}
                                />

                                <InputError message={errors.name} className="mt-2"/>
                            </div>

                            <div className="mt-4 w-full max-w-lg">
                                <InputLabel htmlFor="Code" value="Code"/>

                                <TextInput
                                    id="code"
                                    type="text"
                                    name="code"
                                    value={data.code}
                                    className="mt-1 block w-full"
                                    onChange={(e) => setData('code', e.target.value)}
                                />

                                <InputError message={errors.code} className="mt-2"/>
                            </div>

                            <div className="mt-4 w-full max-w-lg">
                                <InputLabel htmlFor="description" value="Description"/>

                                <textarea
                                    id="description"
                                    name="description"
                                    value={data.description}
                                    className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    onChange={(e) => setData('description', e.target.value)}
                                />

                                <InputError message={errors.description} className="mt-2"/>
                            </div>

                            <div className="mt-4">
                                <PrimaryButton type="submit" className="mt-4" disabled={processing}>
                                    Add Subject
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>

    );
}
