import LinkButton from "@/Components/LinkButton.jsx";
import UniversityCard from "@/Components/Cards/UniversityCard.jsx";
import GeneralLayout from "@/Layouts/GeneralLayout.jsx";
import {useEffect} from "react";

export default function Welcome({auth, laravelVersion, phpVersion, universities}) {
    const handleImageError = () => {
        document.getElementById('screenshot-container')?.classList.add('!hidden');
        document.getElementById('docs-card')?.classList.add('!row-span-1');
        document.getElementById('docs-card-content')?.classList.add('!flex-row');
        document.getElementById('background')?.classList.add('!hidden');
    };

    useEffect(() => {
        if (auth?.user) {
            window.location.href = route('dashboard');
        }
    }, [auth?.user]);

    return (
        <GeneralLayout auth={auth?.user}>

            <div className="flex flex-col justify-center items-center">
                <section className="max-w-2xl text-center flex flex-col items-center justify-center my-6">
                    <h1 className="text-3xl lg:text-6xl font-black">The platform powering your knowledge</h1>
                    <p className="mt-4 text-lg">
                        StudySync is the web application that allows students from all over the world to access
                        educational
                        resources and collaborate with their peers.
                    </p>

                    {/*<img src="/images/welcome-page.jpg" alt="Welcome to StudySync"*/}
                    {/*     className="mt-8 rounded-lg max-w-2xl"/>*/}
                    {!auth.user && (
                        <div className="mt-8 gap-x-5">
                            <LinkButton
                                href={route('register')}
                            >
                                Sign up for free
                            </LinkButton>
                        </div>
                    )}
                </section>
            </div>
            <section className="mt-10 lg:mt-24 flex flex-col items-center">
                <h2 className="text-2xl font-bold">Recently Added Schools</h2>
                <div className="grid lg:grid-cols-3 gap-6 mt-8">
                    {universities.map((university) => (
                        <UniversityCard key={university.id} university={university}/>
                    ))}
                </div>
            </section>
        </GeneralLayout>
    );
}
