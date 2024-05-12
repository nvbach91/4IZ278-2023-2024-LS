import React, { useEffect, useState } from 'react';
import { Head, Link } from '@inertiajs/react';

export default function CartPage() {
    const [cartItems, setCartItems] = useState([]);

    useEffect(() => {
        // Položky košíku z místního úložiště
        const storedCartItems = localStorage.getItem('cartItems');
        if (storedCartItems) {
            setCartItems(JSON.parse(storedCartItems));
        }
    }, []);

    const handleRemoveFromCart = (productId) => {
        // Snížení počtu kusů nebo odstranění položky, pokud je poslední
        const updatedCartItems = cartItems
            .map(item => item.id === productId ? { ...item, quantity: item.quantity - 1 } : item)
            .filter(item => item.quantity > 0);
        setCartItems(updatedCartItems);
        localStorage.setItem('cartItems', JSON.stringify(updatedCartItems));
    };

    const handleAddToCart = (productId) => {
        // Zvýšení počtu kusů produktu, pokud je méně než na skladě
        const updatedCartItems = cartItems.map(item => {
            if (item.id === productId && item.quantity < item.stock) {
                return { ...item, quantity: item.quantity + 1 };
            }
            return item;
        });
        setCartItems(updatedCartItems);
        localStorage.setItem('cartItems', JSON.stringify(updatedCartItems));
    };

    return (
        <>
            <Head title="Nákupní košík" />
            <div className="container mx-auto px-4">
                <h1 className="text-2xl mb-4">Nákupní košík</h1>
                {cartItems.length === 0 ? (
                    <p>Váš košík je prázdný.</p>
                ) : (
                    <div>
                        {cartItems.map((product) => (
                            <div key={product.id} className="mb-4 flex items-center">
                                <img src={`/storage/${product.image}`} alt={product.name} className="w-20 h-20 mr-4" />
                                <div>
                                    <h2 className="text-lg font-semibold">{product.name}</h2>
                                    <p className="text-gray-500">Cena: {product.price} Kč</p>
                                    <p className="text-gray-500">Množství: {product.quantity}</p>
                                    <p className="text-gray-500">Skladem: {product.stock}</p>
                                    <div className="flex products-center">
                                        <button
                                            className="text-red-500 hover:text-red-700 mx-2"
                                            onClick={() => handleRemoveFromCart(product.id)}
                                        >
                                            -
                                        </button>
                                        <button
                                            className={`text-green-500 hover:text-green-700 mx-2 ${
                                                product.quantity >= product.stock ? 'opacity-50 cursor-not-allowed' : ''
                                            }`}
                                            onClick={() => handleAddToCart(product.id)}
                                            disabled={product.quantity >= product.stock}
                                        >
                                            +
                                        </button>
                                        {product.quantity >= product.stock && (
                                            <p className="text-red-500 ml-2">Víc není skladem</p>
                                        )}
                                    </div>
                                </div>
                            </div>
                        ))}
                        <Link
                            href={route('checkout')}
                            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Pokračovat v objednávce
                        </Link>
                    </div>
                )}
            </div>
        </>
    );
}
