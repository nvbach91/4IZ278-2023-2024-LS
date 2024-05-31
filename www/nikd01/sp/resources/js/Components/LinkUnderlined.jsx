import {Link} from "@inertiajs/react";

export default function LinkUnderlined({url, customClass = "", children}) {
    return (
        <div
            className={`inline-flex underline font-semibold underline-offset-4 hover:text-blue-800 hover:underline-offset-8 transition-all duration-300 ${customClass}`}>
            <Link href={url}>{children}</Link>
        </div>
    );
}
