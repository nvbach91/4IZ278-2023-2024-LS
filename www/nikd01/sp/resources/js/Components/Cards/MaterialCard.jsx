import UnderlinedButton from "@/Components/UnderlinedButton.jsx";
import React, {useState} from "react";
import Modal from "@/Components/Modal.jsx";
import LinkButton from "@/Components/LinkButton.jsx";

export default function MaterialCard({material, isAuthenticated = false}) {
    const {title, description, url, ratings} = material || {};

    const [error, setError] = useState(null);

    const shortDescription = description.length > 120 ? `${description.substring(0, 120)}...` : description;

    const materialLink = `/materials/${material.id}`;

    const handleDownload = (url) => {
        if (!isAuthenticated) {
            setError('You must be logged in to download materials.');
            return;
        }
        if (!url) {
            setError('This material is not available for download.');
            return;
        }
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', '');
        document.body.appendChild(link);
        link.click();
        link.remove();
    };

    const averageRating = ratings?.length > 0 ? (ratings.reduce((sum, r) => sum + r.rating, 0) / ratings.length) : null;


    return (
        <div
            className="relative p-4 bg-white flex flex-col text-center rounded-xl border border-black/10 drop-shadow-md hover:border-blue-800 group transition-colors duration-300 min-w-[350px]"
        >
            {averageRating && (
                <div className="absolute top-2 right-2 text-sm font-semibold">
                    <div className="flex items-center gap-1 text-blue-800">
                        <img src="/images/star.svg" alt="star" className="w-4"/>
                        {averageRating.toFixed(2)}
                    </div>
                </div>
            )}
            <div className="py-6 flex flex-col items-center justify-between h-full">
                <a href={materialLink}
                   className="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
                    {title}
                </a>
                <p className="text-sm mt-2">
                    {shortDescription}
                </p>
                <UnderlinedButton onClick={() => handleDownload(url)} className="mt-6">
                    Download
                </UnderlinedButton>
                {error && (
                    <Modal show onClose={() => setError(null)} maxWidth="xl">
                        <div className="px-4 py-6 flex flex-col justify-center items-center gap-y-4">
                            <h1 className="font-bold text-2xl">Something went wrong...</h1>
                            {error}
                            {!isAuthenticated && (
                                <LinkButton href="/login" className="mt-4">
                                    Log in
                                </LinkButton>
                            )}
                        </div>
                    </Modal>
                )}
            </div>
        </div>
    );
}
