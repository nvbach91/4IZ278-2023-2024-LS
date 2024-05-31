import React, {useState} from 'react';

export default function StarRating({rating, onRatingChange}) {
    const [hover, setHover] = useState(0);

    return (
        <div className="flex space-x-1">
            {[...Array(5)].map((star, index) => {
                index += 1;
                return (
                    <button
                        type="button"
                        key={index}
                        className={`text-3xl ${index <= (hover || rating) ? 'text-yellow-500' : 'text-gray-300'}`}
                        onClick={() => onRatingChange(index)}
                        onMouseEnter={() => setHover(index)}
                        onMouseLeave={() => setHover(rating)}
                    >
                        <span className="star">&#9733;</span>
                    </button>
                );
            })}
        </div>
    );
};
