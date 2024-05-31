import React from "react";
import GeneralLayout from "@/Layouts/GeneralLayout.jsx";
import LinkButton from "@/Components/LinkButton.jsx";

export default function ErrorPage({status}) {
    const title = {
        503: '503: Service Unavailable',
        500: '500: Server Error',
        404: 'Page Not Found',
        403: '403: Forbidden',
    }[status]

    const description = {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[status]

    return (
        <GeneralLayout title="Error" auth={null}>
            <section className="w-full flex flex-col items-center justify-center gap-y-8">
                <h1 className="text-3xl font-bold">{title}</h1>
                <img src={status === 404 ? "/images/404.svg" : "/images/error.svg"} alt="Error" className="h-[200px]"/>
                <span className="text-lg">{description}</span>
                <LinkButton href={'/'}>Go back to home</LinkButton>
            </section>
        </GeneralLayout>
    )
}
