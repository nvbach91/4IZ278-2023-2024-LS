export default function UnderlinedButton({className = "", children, ...props}) {
    return (
        <button
            {...props}
            className={`inline-flex underline font-semibold underline-offset-4 hover:text-blue-800 hover:underline-offset-8 transition-all duration-300 ${className}`}>
            {children}
        </button>
    );
}
