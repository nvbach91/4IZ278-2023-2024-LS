import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import React, {useEffect} from "react";
import {Head, useForm} from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel.jsx";
import InputError from "@/Components/InputError.jsx";
import TextInput from "@/Components/TextInput.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";

export default function Create({auth}) {
    const {data, setData, post, processing, errors, reset} = useForm({
        name: '',
        location: '',
        url: ''
    });

    useEffect(() => {
        return () => {
            reset('name', 'location', 'url');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();

        post(route('universities.store'), {
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
                        <h1 className="text-3xl font-bold text-center">Add New University</h1>
                        <form onSubmit={submit} className="mt-4 flex flex-col items-center w-full">
                            <div className="w-full max-w-lg">
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
                                <InputLabel htmlFor="location" value="Location"/>

                                <TextInput
                                    id="location"
                                    type="text"
                                    name="location"
                                    value={data.location}
                                    className="mt-1 block w-full"
                                    onChange={(e) => setData('location', e.target.value)}
                                />

                                <InputError message={errors.location} className="mt-2"/>
                            </div>

                            <div className="mt-4 w-full max-w-lg">
                                <InputLabel htmlFor="url" value="Web URL"/>

                                <TextInput
                                    id="url"
                                    type="text"
                                    name="url"
                                    value={data.url}
                                    className="mt-1 block w-full"
                                    onChange={(e) => setData('url', e.target.value)}
                                />

                                <InputError message={errors.url} className="mt-2"/>
                            </div>

                            <div className="mt-4">
                                <PrimaryButton type="submit" className="mt-4" disabled={processing}>
                                    Add University
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>

    );
}
