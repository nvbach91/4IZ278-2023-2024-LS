import TextInput from "@/Components/TextInput.jsx";

export default function SearchInput({query, setQuery, placeholder = "Search..."}) {
    return (
        <TextInput
            type="text"
            value={query}
            onChange={(e) => setQuery(e.target.value)}
            className="w-full max-w-lg"
            placeholder={placeholder}
        />
    );
};

