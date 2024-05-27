import LinkUnderlined from "@/Components/LinkUnderlined.jsx";

export default function UniversityCard({university}) {
    const {name, location, url} = university;
    return (
        <div
            className="p-4 bg-white flex flex-col text-center rounded-xl border border-black/10 drop-shadow-md hover:border-blue-800 group transition-colors duration-300 min-w-[350px]">
            <div className="py-8">
                <h3 className="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
                    <a href={url} target="_blank" rel="noopener noreferrer">
                        {name}
                    </a>
                </h3>
                <p className="text-sm mt-2">{location}</p>
                <LinkUnderlined url={`/universities/${university.id}`} customClass="mt-8">
                    View Subjects
                </LinkUnderlined>
            </div>
        </div>
    );
}
