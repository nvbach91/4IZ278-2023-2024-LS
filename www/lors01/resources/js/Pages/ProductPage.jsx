import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link, Head } from '@inertiajs/react';
import Dropdown from '@/Components/Dropdown';

export default function ProductPage({ auth, product, canLogin, canRegister }) {
    const [cartItems, setCartItems] = useState([]);
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);

    useEffect(() => {
        const storedCartItems = localStorage.getItem('cartItems');
        if (storedCartItems) {
            setCartItems(JSON.parse(storedCartItems));
        }
    }, []);

    const handleAddToCart = () => {
        const existingItem = cartItems.find(item => item.id === product.id);
        if (existingItem) {
            if (existingItem.quantity < product.stock) {
                existingItem.quantity += 1;
                setCartItems([...cartItems]);
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }
        } else {
            if (product.stock > 0) {
                cartItems.push({ ...product, quantity: 1 });
                setCartItems([...cartItems]);
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }
        }
    };

    const handleRemoveFromCart = () => {
        const existingItem = cartItems.find(item => item.id === product.id);
        if (existingItem.quantity > 1) {
            existingItem.quantity -= 1;
        } else {
            const index = cartItems.indexOf(existingItem);
            cartItems.splice(index, 1);
        }
        setCartItems([...cartItems]);
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
    };

    if (!product) {
        return <div>Načítání...</div>;
    }

    return (
        <>
            <Head title={product.name} />
            <div className="container mx-auto px-4">
                <div className="flex justify-between items-center mb-4">
                    <h1 className="text-2xl">Vítejte v magu</h1>
                    <div className="flex items-center">
                    {auth.user ? (
                            <div className="hidden sm:flex sm:items-center sm:ms-6">
                                <div className="ms-3 relative">
                                    <Dropdown>
                                        <Dropdown.Trigger>
                                            <span className="inline-flex rounded-md">
                                                <button
                                                    type="button"
                                                    className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                                >
                                                    {auth.user.name}

                                                    <svg
                                                        className="ms-2 -me-0.5 h-4 w-4"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20"
                                                        fill="currentColor"
                                                    >
                                                        <path
                                                            fillRule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clipRule="evenodd"
                                                        />
                                                    </svg>
                                                </button>
                                            </span>
                                        </Dropdown.Trigger>

                                        <Dropdown.Content>
                                            <Dropdown.Link href={route('profile.edit')}>Profil</Dropdown.Link>
                                            <Dropdown.Link href={route('logout')} method="post" as="button">
                                                Odhlásit se
                                            </Dropdown.Link>
                                        </Dropdown.Content>
                                    </Dropdown>
                                </div>
                            </div>
                        ) : (
                            <>
                                <Link href={route('login')} className="text-sm text-gray-700 underline">
                                    Přihlásit se
                                </Link>
                                <Link href={route('register')} className="ml-4 text-sm text-gray-700 underline">
                                    Registrovat
                                </Link>
                            </>
                        )}
                        <div className="-me-2 flex items-center sm:hidden">
                            <button
                                onClick={() => setShowingNavigationDropdown((previousState) => !previousState)}
                                className="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg className="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        className={!showingNavigationDropdown ? 'inline-flex' : 'hidden'}
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        className={showingNavigationDropdown ? 'inline-flex' : 'hidden'}
                                        strokeLinecap="round"
                                        strokeLinejoin="round"
                                        strokeWidth="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                        <Link href={route('cart')} className="ml-4 text-sm text-gray-700 underline">
                            Košík ({cartItems.reduce((acc, item) => acc + item.quantity, 0)})
                        </Link>
                    </div>
                </div>
                <div className="flex">
                    <div className="w-1/2">
                        <img src={`/storage/${product.image}`} alt={product.name} className="w-full h-auto" />
                    </div>
                    <div className="w-1/2 pl-8">
                        <h1 className="text-2xl font-bold mb-2">{product.name}</h1>
                        <p className="text-gray-700 mb-4">{product.description}</p>
                        <p className="text-lg font-bold mb-2">{product.price} Kč</p>
                        <p className="text-sm mb-4">Skladem: {product.stock} ks</p>
                        <div className="flex items-center">
                            {cartItems.find(item => item.id === product.id) ? (
                                <div className="flex items-center">
                                    <button
                                        className="hover:bg-red-700 text-white font-bold py-1 px-2 rounded bg-gray-500 rounded-1xl"
                                        onClick={handleRemoveFromCart}
                                    >
                                        -
                                    </button>
                                    <span className="mx-2">{cartItems.find(item => item.id === product.id).quantity}</span>
                                    <button
                                        className={`bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded ${
                                            cartItems.find(item => item.id === product.id).quantity >= product.stock
                                                ? 'opacity-50 cursor-not-allowed'
                                                : ''
                                        }`}
                                        onClick={handleAddToCart}
                                        disabled={cartItems.find(item => item.id === product.id).quantity >= product.stock}
                                    >
                                        +
                                    </button>
                                    {cartItems.find(item => item.id === product.id).quantity >= product.stock && (
                                        <p className="text-red-500 ml-2">Víc není skladem</p>
                                    )}
                                </div>
                            ) : (
                                <button
                                    className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    onClick={handleAddToCart}
                                >
                                    Přidat do košíku
                                </button>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}