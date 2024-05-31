import LinkUnderlined from "@/Components/LinkUnderlined.jsx";

export default function UniversityCard({university}) {
    const {name, location, subjects_count} = university || {};
    return (
        <div
            className="p-4 bg-white flex flex-col text-center rounded-xl border border-black/10 drop-shadow-md hover:border-blue-800 group transition-colors duration-300 min-w-[350px]">
            <div className="py-8">
                <h3 className="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
                    {name}
                </h3>
                <p className="text-sm mt-2">{location}</p>
                <LinkUnderlined url={`/universities/${university.id}`} customClass="mt-8">
                    View {subjects_count ?? ''} Subjects
                </LinkUnderlined>
            </div>
        </div>
    );
}
