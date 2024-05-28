import React, { useEffect, useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import '../../css/cartPage.css';
import ApplicationLogo from '@/Components/ApplicationLogo';
import NavLink from '@/Components/NavLink';
import Dropdown from '@/Components/Dropdown';


export default function CartPage({auth}) {
    const [cartItems, setCartItems] = useState([]);
    const [isActive, setIsActive] = useState(false);

    useEffect(() => {
        // Load cart items from local storage
        const storedCartItems = localStorage.getItem('cartItems');
        if (storedCartItems) {
            setCartItems(JSON.parse(storedCartItems));
        }
    }, []);

    const handleRemoveFromCart = (productId) => {
        // Decrease item quantity or remove item if last one
        const updatedCartItems = cartItems
            .map(item => item.id === productId ? { ...item, quantity: item.quantity - 1 } : item)
            .filter(item => item.quantity > 0);
        setCartItems(updatedCartItems);
        localStorage.setItem('cartItems', JSON.stringify(updatedCartItems));
    };

    const handleAddToCart = (productId) => {
        // Increase item quantity if less than stock
        const updatedCartItems = cartItems.map(item => {
            if (item.id === productId && item.quantity < item.stock) {
                return { ...item, quantity: item.quantity + 1 };
            }
            return item;
        });
        setCartItems(updatedCartItems);
        localStorage.setItem('cartItems', JSON.stringify(updatedCartItems));
    };

    const handleToggle = () => {
        setIsActive(!isActive);
    };

    return (
        <>
            <Head title="Nákupní košík" />
            <div className="cart-container mx-auto px-4">
            <div className="header">
                    <div className="header-content">
                        {auth.user ? (
                            <div className="auth-user-container">
                                <div className="auth-user-content">
                                    <div className="auth-user-logo">
                                        <Link href="/">
                                            <ApplicationLogo className="logo" />
                                        </Link>
                                    </div>
                                    <div className="nav-links">
                                        <NavLink href={route('dashboard')} active={route().current('dashboard')}>Přehled</NavLink>
                                        {auth.user.role === 'admin' && (
                                            <NavLink href={route('admin.index')} active={route().current('admin.index')}>Administrátorský přehled</NavLink>
                                        )}
                                    </div>
                                </div>
                                <div className="right-container">
                                    <div className="auth-user-dropdown">
                                        <div className="dropdown-container">
                                            <Dropdown>
                                                <Dropdown.Trigger>
                                                    <span className="dropdown-trigger">
                                                        <button type="button" className="dropdown-button">
                                                            {auth.user.name}
                                                            <svg className="dropdown-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fillRule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clipRule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </span>
                                                </Dropdown.Trigger>
                                                <Dropdown.Content>
                                                    <Dropdown.Link href={route('profile.edit')}>Profil</Dropdown.Link>
                                                    <Dropdown.Link href={route('logout')} method="post" as="button">Odhlásit se</Dropdown.Link>
                                                </Dropdown.Content>
                                            </Dropdown>
                                        </div>
                                    </div>
                                    <Link href={route('cart')} className="cart-link">
                                        <span className="cart-icon"></span>
                                        Košík (<span className="cart-count">{cartItems.reduce((acc, item) => acc + item.quantity, 0)}</span>)
                                    </Link>
                                    <div id="menu-toggle" onClick={handleToggle}>
                                        <div id="menu-icon" className={isActive ? 'active' : ''}>
                                            <div className="bar"></div>
                                            <div className="bar bar2"></div>
                                            <div className="bar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ) : (
                            <>
                                <div className="guest-header">
                                    <div className="auth-user-logo">
                                        <Link href="/">
                                            <ApplicationLogo className="logo" />
                                        </Link>
                                    </div>
                                    <div className="right-container">
                                        <Link href={route('login')} className="login-link">Přihlásit se</Link>
                                        <Link href={route('register')} className="register-link">Registrovat</Link>
                                        <Link href={route('cart')} className="cart-link">
                                            <span className="cart-icon"></span>
                                            Košík (<span className="cart-count">{cartItems.reduce((acc, item) => acc + item.quantity, 0)}</span>)
                                        </Link>
                                    </div>
                                </div>
                            </>
                        )}
                    </div>
                </div>
                <h1 className="cart-title">Nákupní košík</h1>
                {cartItems.length === 0 ? (
                    <p className="cart-empty-message">Váš košík je prázdný.</p>
                ) : (
                    <div>
                        {cartItems.map((product) => (
                            <div key={product.id} className="cart-item">
                                <img src={`/storage/${product.image}`} alt={product.name} />
                                <div className='cart-info-container'>
                                    <h2 className="cart-item-name">{product.name}</h2>
                                    <p className="cart-item-price">Cena: {product.price} Kč</p>
                                    <p className="cart-item-quantity">Množství: {product.quantity}</p>
                                    <p className="cart-item-stock">Skladem: {product.stock}</p>
                                    <div className="cart-item-actions">
                                        <button
                                            className="cart-button cart-button-remove cart-mx-2"
                                            onClick={() => handleRemoveFromCart(product.id)}
                                        >
                                            -
                                        </button>
                                        <button
                                            className={`cart-button cart-button-add cart-mx-2 ${
                                                product.quantity >= product.stock ? 'cart-disabled' : ''
                                            }`}
                                            onClick={() => handleAddToCart(product.id)}
                                            disabled={product.quantity >= product.stock}
                                        >
                                            +
                                        </button>
                                        {product.quantity >= product.stock && (
                                            <p className="cart-warning">Víc není skladem</p>
                                        )}
                                    </div>
                                </div>
                            </div>
                        ))}
                        <Link
                            href={route('checkout')}
                            className="cart-checkout-button"
                        >
                            Pokračovat v objednávce
                        </Link>
                    </div>
                )}
            </div>
        </>
    );
}
