import React, { useEffect, useState } from 'react';
import { Head, Link } from '@inertiajs/react';
import Dropdown from '@/Components/Dropdown';
import ApplicationLogo from '@/Components/ApplicationLogo';
import NavLink from '@/Components/NavLink';

export default function OrderConfirmation({auth}) {
    const [cartItems, setCartItems] = useState([]);
    const [isActive, setIsActive] = useState(false);

    const handleToggle = () => {
        setIsActive(!isActive);
    };
    

    useEffect(() => {
        // Vymazat položky košíku a data pokladny z localStorage
        localStorage.removeItem('cartItems');
        localStorage.removeItem('checkoutData');
    }, []);

    return (
        <>
            <Head title="Potvrzení objednávky" />
            <div className="container mx-auto px-4">
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
                <div className="text-center py-8">
                    <h1 className="text-4xl font-bold mb-4">Děkujeme za vaši objednávku!</h1>
                    <p className="text-xl mb-8">Vaše objednávka byla úspěšně zadaná.</p>
                    <div className="mb-8">
                        <p className="text-lg">Datum objednávky: <span className="font-bold">{new Date().toLocaleDateString()}</span></p>
                    </div>
                    <p className="text-lg mb-8">Brzy obdržíte potvrzení e-mailem s detaily vaší objednávky.</p>
                    <div className="flex justify-center">
                        <Link href="/" className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Pokračovat v nakupování
                        </Link>
                    </div>
                </div>
            </div>
        </>
    );
}
