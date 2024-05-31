import LinkUnderlined from "@/Components/LinkUnderlined.jsx";

export default function SubjectCard({subject}) {
    const {name, code, description, materials_count} = subject || {};

    return (
        <div
            className="p-4 bg-white flex flex-col text-center rounded-xl border border-black/10 drop-shadow-md hover:border-blue-800 group transition-colors duration-300">
            <div className="self-start text-xs font-bold text-blue-800">{code}</div>
            <div className="py-8">
                <h3 className="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
                    {name}
                </h3>
                <p className="text-sm mt-4">{description}</p>
                <LinkUnderlined url={`/subjects/${subject.id}`} customClass="mt-8">
                    View {materials_count ?? ''} Materials
                </LinkUnderlined>
            </div>
        </div>
    );
}
