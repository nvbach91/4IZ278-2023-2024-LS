import {Link} from "@inertiajs/react";

export default function LinkButton({className = '', children, ...props}) {
    return (
        <Link {...props}
              className={`inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:bg-blue-900 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 duration-300 transition-colors ${className}`}>
            {children}
        </Link>
    )
}
