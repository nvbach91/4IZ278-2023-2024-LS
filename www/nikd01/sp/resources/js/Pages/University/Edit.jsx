import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import React from "react";
import {Head, useForm} from "@inertiajs/react";
import InputLabel from "@/Components/InputLabel.jsx";
import InputError from "@/Components/InputError.jsx";
import TextInput from "@/Components/TextInput.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import Modal from "@/Components/Modal.jsx";
import {Inertia} from "@inertiajs/inertia";

export default function Edit({auth, university}) {
    const {data, setData, patch, processing, errors} = useForm({
        name: university?.name || '',
        location: university?.location || '',
        url: university?.url || '',
    });

    const [initialUniversity] = React.useState(university);

    const [isModalOpen, setIsModalOpen] = React.useState(false);
    const [isDeleteModalOpen, setIsDeleteModalOpen] = React.useState(false);

    const isSomeDataChanged = () => {
        return initialUniversity.name !== data.name || initialUniversity.location !== data.location || initialUniversity.url !== data.url;
    }
    const submit = (e) => {
        e.preventDefault();

        patch(route('universities.update', university.id), {
            onSuccess: () => console.log('success'),
        });
    };

    const submitDelete = (e) => {
        e.preventDefault();

        Inertia.delete(route('universities.destroy', university.id), {
            onSuccess: () => console.log('success'),
        });
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            // header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title={`Edit ${university.name}`}/>

            <Modal show={isModalOpen} onClose={() => setIsModalOpen(false)} maxWidth="md">
                <div className="flex flex-col justify-center items-center text-center p-5">
                    <h1 className="text-2xl font-bold">Nothing has been changed</h1>
                    <p className="mt-2">Please make some changes before submitting</p>
                    <PrimaryButton onClick={() => setIsModalOpen(false)} className="mt-8">
                        Close
                    </PrimaryButton>
                </div>
            </Modal>

            <Modal show={isDeleteModalOpen} onClose={() => setIsDeleteModalOpen(false)} maxWidth="md">
                <div className="flex flex-col justify-center items-center text-center p-5">
                    <h1 className="text-2xl font-bold">Are you sure you want to delete this university with all of its
                        content?</h1>
                    <div className="flex items-center justify-center gap-x-4 mt-6">
                        <form onSubmit={submitDelete}>
                            <PrimaryButton type="submit"
                                           className="bg-red-500 hover:bg-red-500/80 active:bg-red-500 focus:bg-red-500 focus:ring-0">
                                Delete
                            </PrimaryButton>
                        </form>
                        <PrimaryButton onClick={() => setIsDeleteModalOpen(false)}>
                            Cancel
                        </PrimaryButton>
                    </div>
                </div>
            </Modal>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div
                        className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div className="flex flex-col items-center">
                            <h1 className="text-3xl font-bold text-center">Editing</h1>
                            <span className="text-2xl text-center mt-2 text-black/50">{university.name}</span>
                        </div>
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

                            <div className="mt-8 flex justify-center items-center gap-x-6">
                                {isSomeDataChanged() ? (
                                    <PrimaryButton type="submit" disabled={processing}>
                                        Update University
                                    </PrimaryButton>
                                ) : (
                                    <PrimaryButton type="button" onClick={() => setIsModalOpen(true)}>
                                        Update University
                                    </PrimaryButton>
                                )}
                                <PrimaryButton
                                    className="bg-red-500 hover:bg-red-500/80 active:bg-red-500 focus:bg-red-500 focus:ring-0"
                                    type="button"
                                    onClick={() => setIsDeleteModalOpen(true)}>
                                    Delete
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>

    );
}
