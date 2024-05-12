export default function UniversityCard({university}) {
    const {name, location, url} = university;
    return (
        <div
            className="p-4 bg-white/5 flex flex-col text-center rounded-xl border border-transparent hover:border-blue-800 group transition-colors duration-300">
            <div className="py-8">
                <h3 className="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
                    <a href={url} target="_blank" rel="noopener noreferrer">
                        {name}
                    </a>
                </h3>
                <p className="text-sm mt-4">{location}</p>
            </div>
        </div>
    );
}
