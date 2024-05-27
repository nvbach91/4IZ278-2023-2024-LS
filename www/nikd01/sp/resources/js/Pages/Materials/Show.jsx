import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.jsx";
import {Head, useForm} from "@inertiajs/react";
import GeneralLayout from "@/Layouts/GeneralLayout.jsx";
import Modal from "@/Components/Modal.jsx";
import LinkButton from "@/Components/LinkButton.jsx";
import React, {useState} from "react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import UnderlinedButton from "@/Components/UnderlinedButton.jsx";
import TextInput from "@/Components/TextInput.jsx";
import StarRating from "@/Components/StarRating.jsx";
import moment from "moment";
import {Inertia} from "@inertiajs/inertia";

export default function Show({auth, material, canDelete}) {
    const isAuthenticated = auth && auth.user

    return (
        isAuthenticated ? (
            <AuthenticatedLayout
                user={auth.user}
                // header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
            >
                <Head title={material.title}/>
                <div className="py-12">
                    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <MaterialContent material={material} isAuthenticated auth={auth} canDelete={canDelete}/>
                        </div>
                    </div>
                </div>
            </AuthenticatedLayout>
        ) : (
            <GeneralLayout title={material.title} auth={auth}>
                <MaterialContent material={material} isAuthenticated={false} auth={auth} canDelete={false}/>
            </GeneralLayout>)
    )
}

function MaterialContent({material, isAuthenticated, auth, canDelete}) {
    const {title, description, url, ratings, comments} = material || {};

    const [error, setError] = useState(null);
    const [showReviewModal, setShowReviewModal] = useState(false);
    const [showDeleteModal, setShowDeleteModal] = useState(false);

    const {data, setData, post, processing, errors} = useForm({
        rating: '',
        comment_text: '',
    });

    const openDeleteModal = () => {
        setShowDeleteModal(true);
    }

    const closeDeleteModal = () => {
        setShowDeleteModal(false);
    }

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

    const submitReview = (e) => {
        e.preventDefault();
        post(route('materials.storeReview', material.id), {
            onSuccess: () => setShowReviewModal(false),
        });
    };

    const deleteMaterial = (e) => {
        e.preventDefault();

        Inertia.delete(route('materials.destroy', material.id), {
            onSuccess: () => setShowDeleteModal(false),
        });

    }

    const deleteComment = (commentId) => {
        Inertia.delete(route('materials.destroyComment', {material: material.id, comment: commentId}))
    }

    const hasAlreadyBeenReviewed = ratings?.find(r => r?.user_id === auth?.user.id);
    const isUsersOwnMaterial = auth?.user?.id === material?.user_id;

    return (
        <>
            <Modal show={showDeleteModal} maxWidth="md">
                <div className="px-4 py-6 flex flex-col justify-center items-center gap-y-4">
                    <h1 className="font-bold text-2xl text-center">Are you sure you want to delete this material?</h1>
                    <form onSubmit={deleteMaterial}>
                        <div className="flex gap-4">
                            <UnderlinedButton type="submit"
                                              className="text-red-500 hover:text-red-500/80">Delete</UnderlinedButton>
                            <UnderlinedButton type="button" onClick={closeDeleteModal}>Cancel</UnderlinedButton>
                        </div>
                    </form>
                </div>
            </Modal>
            <section className="flex flex-col items-center gap-6 ">
                <h1 className="font-bold text-3xl text-center">{title}</h1>
                <p className="text-center max-w-2xl">{description}</p>

                <div className="text-lg flex items-start gap-1">
                    <strong>Rating:</strong>
                    {ratings?.length > 0 ? (
                        <div className="flex items-center gap-2">
                            <span>{(ratings.reduce((sum, r) => sum + r.rating, 0) / ratings.length).toFixed(1)} / 5.0</span>
                            <span
                                className="text-sm text-black/70">({ratings.length} review{ratings.length > 1 ? 's' : ''})</span>
                        </div>
                    ) : (
                        <span>
                        No ratings yet
                    </span>
                    )}
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton onClick={() => handleDownload(url)}>
                        Download
                    </PrimaryButton>
                    {canDelete && (
                        <UnderlinedButton className="text-red-500 hover:text-red-500/80" onClick={openDeleteModal}>
                            Delete
                        </UnderlinedButton>
                    )}
                </div>

                <div className="flex flex-col justify-center items-center mt-6 w-full">
                    <h3 className="font-bold text-2xl">Comments</h3>
                    <div className="mt-4 flex flex-col gap-4 w-full items-center">
                        {comments?.length > 0 ? comments.map((comment) => (
                            <div key={comment.id}
                                 className="border border-black/20 px-4 py-2 max-w-md w-full rounded-xl rounded-bl-none">
                                <div>
                                    <div className="flex justify-start gap-4">
                                        <img src="/images/comment.svg" alt="Comment"
                                             className="h-[28px] w-[28px] pt-1"/>
                                        <div>
                                            <strong>{comment?.user?.name}</strong>
                                            <p>{comment?.comment_text}</p>
                                        </div>
                                        {(comment?.user_id === auth?.user?.id || auth?.user?.is_admin || isUsersOwnMaterial) && (
                                            <button onClick={() => deleteComment(comment.id)}
                                                    className="text-red-500 hover:text-red-500/80 text-sm ml-auto">Delete</button>
                                        )}
                                    </div>
                                    <p className="text-xs text-right">{moment(comment?.created_at).fromNow()}</p>

                                </div>
                            </div>
                        )) : (
                            <p>No comments yet. Be the first to comment!</p>
                        )}
                    </div>
                    {isAuthenticated && (
                        <UnderlinedButton className="mt-6" onClick={() => setShowReviewModal(true)}>
                            Add Review
                        </UnderlinedButton>
                    )}
                </div>

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

                {showReviewModal && (
                    <Modal show onClose={() => setShowReviewModal(false)} maxWidth="md">
                        {hasAlreadyBeenReviewed || isUsersOwnMaterial ? (
                            <div className="px-4 py-6 flex flex-col justify-center items-center gap-y-6">
                                <h1 className="font-bold text-2xl">
                                    {hasAlreadyBeenReviewed ? 'You\'ve already reviewed this material' : 'You can\'t review your own materials'}</h1>
                                <img src="/images/review-added.svg" alt="Review added" className="h-[120px]"/>
                                {hasAlreadyBeenReviewed && (<p className="font-semibold">You can only review once</p>)}
                                <PrimaryButton onClick={() => setShowReviewModal(false)}>Go back</PrimaryButton>
                            </div>
                        ) : (
                            <form onSubmit={submitReview} className="flex flex-col gap-4 p-6">
                                <h2 className="text-2xl font-bold">Add Review</h2>
                                <div className="flex items-center gap-4">
                                    <label htmlFor="rating">Rating</label>
                                    <StarRating
                                        rating={data.rating}
                                        onRatingChange={(rating) => setData('rating', rating)}
                                    />
                                </div>
                                {errors.rating && <div className="text-red-600">{errors.rating}</div>}
                                <label htmlFor="comment_text">Comment (optional)</label>
                                <TextInput
                                    id="comment_text"
                                    type="text"
                                    value={data.comment_text}
                                    onChange={(e) => setData('comment_text', e.target.value)}
                                />
                                {errors.comment_text && <div className="text-red-600">{errors.comment_text}</div>}
                                <div className="flex items-center justify-between">
                                    <PrimaryButton type="submit" disabled={processing}>Submit</PrimaryButton>
                                    <UnderlinedButton
                                        onClick={() => setShowReviewModal(false)}>Cancel</UnderlinedButton>
                                </div>
                            </form>
                        )}
                    </Modal>
                )}
            </section>
        </>
    );
}
