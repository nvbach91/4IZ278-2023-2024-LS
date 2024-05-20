import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link, Head } from '@inertiajs/react';
import Dropdown from '@/Components/Dropdown';
import '../../css/productPage.css';
import ApplicationLogo from '@/Components/ApplicationLogo';
import NavLink from '@/Components/NavLink';

export default function ProductPage({ auth, product, canLogin, canRegister }) {
    const [cartItems, setCartItems] = useState([]);
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);
    const [isActive, setIsActive] = useState(false);

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


    const handleToggle = () => {
        setIsActive(!isActive);
    };


    if (!product) {
        return <div>Načítání...</div>;
    }

    return (
        <>
            <Head title={product.name} />
            <div className="product-container">
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
                <div className="product-product-container">
                    <div className="product-product-image">
                        <img src={`/storage/${product.image}`} alt={product.name} />
                    </div>
                    <div className="product-product-details">
                        <h1 className="product-product-name">{product.name}</h1>
                        <p className="product-product-description">{product.description}</p>
                        <p className="product-product-price">{product.price} Kč</p>
                        <p className="product-product-stock">Skladem: {product.stock} ks</p>
                        <div className="product-cart-actions">
                            {cartItems.find(item => item.id === product.id) ? (
                                <div className="product-cart-item-actions">
                                    <button className="product-cart-button product-remove-button" onClick={handleRemoveFromCart}>-</button>
                                    <span className="product-cart-quantity">{cartItems.find(item => item.id === product.id).quantity}</span>
                                    <button className={`product-cart-button product-add-button ${cartItems.find(item => item.id === product.id).quantity >= product.stock ? 'product-disabled' : ''}`} onClick={handleAddToCart} disabled={cartItems.find(item => item.id === product.id).quantity >= product.stock}>+</button>
                                    {cartItems.find(item => item.id === product.id).quantity >= product.stock && <p className="product-stock-warning">Víc není skladem</p>}
                                </div>
                            ) : (
                                <button className="product-add-to-cart-button" onClick={handleAddToCart}>Přidat do košíku</button>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
