import React, {useEffect, useRef, useState} from 'react';

export default function FileInput({className = '', isFocused = false, onChange, ...props}) {
    const inputRef = useRef();
    const [isDragging, setIsDragging] = useState(false);
    const [file, setFile] = useState(null);

    useEffect(() => {
        if (isFocused) {
            inputRef.current.focus();
        }
    }, [isFocused]);

    const handleDragEnter = (e) => {
        e.preventDefault();
        e.stopPropagation();
        setIsDragging(true);
    };

    const handleDragLeave = (e) => {
        e.preventDefault();
        e.stopPropagation();
        setIsDragging(false);
    };

    const handleDragOver = (e) => {
        e.preventDefault();
        e.stopPropagation();
    };

    const handleDrop = (e) => {
        e.preventDefault();
        e.stopPropagation();
        setIsDragging(false);
        if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
            const droppedFile = e.dataTransfer.files[0];
            setFile(droppedFile);
            if (onChange) {
                onChange({target: {files: [droppedFile]}});
            }
            e.dataTransfer.clearData();
        }
    };

    const handleChange = (e) => {
        const selectedFile = e.target.files[0];
        setFile(selectedFile);
        if (onChange) {
            onChange(e);
        }
    };

    const handleRemoveFile = () => {
        setFile(null);
        if (onChange) {
            onChange({target: {files: []}});
        }
    };

    return (
        <div
            className={`border-2 border-dashed rounded-md px-4 py-10 ${isDragging ? 'border-indigo-500' : 'border-gray-300'} ${className}`}
            onDragEnter={handleDragEnter}
            onDragLeave={handleDragLeave}
            onDragOver={handleDragOver}
            onDrop={handleDrop}
            onClick={() => inputRef.current.click()}
        >
            <input
                {...props}
                type="file"
                ref={inputRef}
                style={{display: 'none'}}
                onChange={handleChange}
            />
            {file ? (
                <div className="flex justify-between items-center">
                    <span className="text-gray-700">{file.name}</span>
                    <button
                        type="button"
                        className="ml-4 text-red-500"
                        onClick={handleRemoveFile}
                    >
                        Remove
                    </button>
                </div>
            ) : (
                <p className="text-center text-gray-500">
                    Drag and drop a file here, or click to select a file
                </p>
            )}
        </div>
    );
}
