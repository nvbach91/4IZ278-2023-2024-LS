import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import InputLabel from "@/Components/InputLabel.jsx";
import TextInput from "@/Components/TextInput.jsx";
import InputError from "@/Components/InputError.jsx";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import React, {useEffect} from "react";
import {Head, useForm, usePage} from "@inertiajs/react";
import FileInput from "@/Components/FileInput.jsx";
import {getQueryParams} from "@/utils/utils.js";

export default function Create({auth, universities, subjects}) {
    const {url} = usePage();
    const queryParams = getQueryParams(url) || {};
    const {data, setData, post, processing, errors, reset} = useForm({
        title: '',
        description: '',
        file: null,
        subject_id: queryParams.subject || '',
    });

    const initialUniversityId = subjects?.find((subject) => subject.id === parseInt(data.subject_id))?.university_id;

    const [universityId, setUniversityId] = React.useState(initialUniversityId);

    useEffect(() => {
        setData('subject_id', queryParams.subject || '');
        return () => {
            reset('title', 'description', 'file');
        };
    }, [url]);

    const handleFileChange = (e) => {
        setData('file', e.target.files[0]);
    };

    const submit = (e) => {
        e.preventDefault();

        post(route('materials.store'), {
            forceFormData: true,
            onSuccess: () => console.log('success'),
        });
    };

    const filteredSubjects = subjects.map((subject) => {
        if (subject.university_id === parseInt(universityId)) {
            return subject;
        }
    }).filter((subject) => subject !== undefined);

    return (
        <AuthenticatedLayout
            user={auth.user}
            // header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
        >
            <Head title="Add New Material"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div
                        className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h1 className="text-3xl font-bold text-center">Add new material</h1>
                        <form onSubmit={submit} className="mt-4 flex flex-col items-center w-full">
                            <div className="w-full max-w-lg">
                                <InputLabel htmlFor="University" value="University"/>

                                <select
                                    id="university"
                                    name="university"
                                    className="mt-1 block w-full rounded-md border-gray-300"
                                    value={universityId}
                                    onChange={(e) => setUniversityId(e.target.value)}
                                >
                                    <option value="">Select a university</option>
                                    {universities.map((university) => (
                                        <option key={university.id} value={university.id}>{university.name}</option>
                                    ))}
                                </select>
                            </div>

                            <div className="mt-4 w-full max-w-lg">
                                <InputLabel htmlFor="Subject" value="Subject"/>

                                <select
                                    id="subject"
                                    name="subject"
                                    className="mt-1 block w-full rounded-md border-gray-300"
                                    value={data.subject_id}
                                    onChange={(e) => setData('subject_id', e.target.value)}
                                    disabled={!filteredSubjects.length}
                                >
                                    <option value="">Select a subject</option>
                                    {filteredSubjects.map((subject) => (
                                        <option key={subject.id} value={subject.id}>{subject.name}</option>
                                    ))}
                                </select>

                                <InputError message={errors.subject_id} className="mt-2"/>
                            </div>

                            <div className="mt-4 w-full max-w-lg">
                                <InputLabel htmlFor="title" value="Title"/>

                                <TextInput
                                    id="title"
                                    type="text"
                                    name="title"
                                    value={data.title}
                                    className="mt-1 block w-full"
                                    isFocused={true}
                                    onChange={(e) => setData('title', e.target.value)}
                                />

                                <InputError message={errors.title} className="mt-2"/>
                            </div>

                            <div className="mt-4 w-full max-w-lg">
                                <InputLabel htmlFor="description" value="Description"/>

                                <TextInput
                                    id="description"
                                    type="text"
                                    name="description"
                                    value={data.description}
                                    className="mt-1 block w-full"
                                    onChange={(e) => setData('description', e.target.value)}
                                />

                                <InputError message={errors.description} className="mt-2"/>
                            </div>

                            <div className="mt-4 w-full max-w-lg">
                                <InputLabel htmlFor="file" value="File"/>

                                <FileInput
                                    id="file"
                                    name="file"
                                    className="mt-1 block w-full"
                                    onChange={handleFileChange}
                                />

                                <InputError message={errors.file} className="mt-2"/>
                            </div>

                            <div className="mt-4">
                                <PrimaryButton type="submit" className="mt-4" disabled={processing}>
                                    Add material
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>

    );
}
