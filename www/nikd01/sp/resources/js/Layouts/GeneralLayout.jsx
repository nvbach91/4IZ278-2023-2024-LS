import {Head, Link} from "@inertiajs/react";
import ApplicationLogo from "@/Components/ApplicationLogo.jsx";

export default function GeneralLayout({auth, title = 'Welcome', children}) {
    return (
        <>
            <Head title={title}/>
            <div className="bg-gray-50 text-black/80 min-h-screen flex flex-col">
                <header className="sticky top-0 w-full bg-gray-50 py-4 z-10">
                    <div className="relative max-w-2xl px-6 lg:max-w-7xl mx-auto flex justify-between items-center">
                        <div className="shrink-0 flex items-center">
                            <Link href="/">
                                <ApplicationLogo className="block h-9 w-auto fill-current text-gray-800"/>
                            </Link>
                        </div>
                        <nav className="-mx-3 flex flex-1 justify-end">
                            {auth?.id ? (
                                <Link
                                    href={route('dashboard')}
                                    className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                    Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Register
                                    </Link>
                                </>
                            )}
                        </nav>
                    </div>
                </header>
                <main className="flex-1 my-6 w-full max-w-2xl lg:max-w-7xl mx-auto px-6">
                    {children}
                </main>
                <footer className="mt-auto py-8 text-center text-sm text-black">
                    Built by Dmitrii Nikolaev, {new Date().getFullYear()}
                </footer>
            </div>
        </>
    );
}
