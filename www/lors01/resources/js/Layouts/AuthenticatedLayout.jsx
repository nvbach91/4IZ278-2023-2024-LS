import { useState, useEffect } from 'react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link } from '@inertiajs/react';
import Modal from '@/Components/Modal'; // Import the Modal component
import '../../css/authenticatedPage.css'; // Import the CSS file

export default function Authenticated({ user, header, children }) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);
    const [orders, setOrders] = useState([]);
    const [selectedOrder, setSelectedOrder] = useState(null); // State to store the selected order for modal
    const [isModalOpen, setIsModalOpen] = useState(false); // State to control modal visibility
    const [cartItems, setCartItems] = useState([]);
    const [isActive, setIsActive] = useState(false);

    const handleToggle = () => {
        setIsActive(!isActive);
    };
    
    useEffect(() => {
        fetch(route('orders.index'))
            .then((response) => response.json())
            .then((data) => setOrders(data))
            .catch((error) => console.error('Chyba:', error));
    }, []);

    const handleOrderClick = (order) => {
        setSelectedOrder(order);
        setIsModalOpen(true);
    };

    return (
        <div className="authenticated-container">
            <nav className="authenticated-nav">
            <div className="header">
                    <div className="header-content">
                        {user ? (
                            <div className="auth-user-container">
                                <div className="auth-user-content">
                                    <div className="auth-user-logo">
                                        <Link href="/">
                                            <ApplicationLogo className="logo" />
                                        </Link>
                                    </div>
                                    <div className="nav-links">
                                        <NavLink href={route('dashboard')} active={route().current('dashboard')}>Přehled</NavLink>
                                        {user.role === 'admin' && (
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
                                                            {user.name}
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

                <div className={(showingNavigationDropdown ? 'authenticated-responsive-menu active' : 'authenticated-responsive-menu')}>
                    <div className="authenticated-responsive-menu-links">
                        <ResponsiveNavLink href={route('dashboard')} active={route().current('dashboard')} className="authenticated-responsive-menu-link">
                            Přehled
                        </ResponsiveNavLink>
                    </div>

                    <div className="authenticated-responsive-user-info">
                        <div className="authenticated-user-name">{user.name}</div>
                        <div className="authenticated-user-email">{user.email}</div>

                        <div className="mt-3 space-y-1">
                            <ResponsiveNavLink href={route('profile.edit')} className="authenticated-responsive-menu-link">Profil</ResponsiveNavLink>
                            <ResponsiveNavLink method="post" href={route('logout')} as="button" className="authenticated-responsive-menu-link">
                                Odhlásit se
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <main>
                {/* {header && (
                    <header className="bg-white shadow">
                        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">{header}</div>
                    </header>
                )} */}

                <div className="authenticated-order-history">
                    <div className="authenticated-order-history-inner">
                        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div className="p-6 bg-white border-b border-gray-200">
                                <h2 className="authenticated-order-history-title">Historie objednávek</h2>
                                {orders.length === 0 ? (
                                    <p>Žádné objednávky nenalezeny.</p>
                                ) : (
                                    <div>
                                        {orders.map(order => (
                                            <div key={order.id} className="authenticated-order">
                                                <h3 className="authenticated-order-id">ID objednávky: {order.id}</h3>
                                                <p className="authenticated-order-summary">
                                                    <span>Celková cena:</span> {order.total_price}
                                                    <span className="ml-4">Stav:</span> {order.status}
                                                    <span className="ml-4">Způsob dopravy:</span> {order.shipping_method}
                                                </p>
                                                <button
                                                    className="authenticated-order-details-button"
                                                    onClick={() => handleOrderClick(order)}
                                                >
                                                    Zobrazit detaily
                                                </button>
                                            </div>
                                        ))}
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>

                {children}
            </main>

            <Modal show={isModalOpen} onClose={() => setIsModalOpen(false)}>
                {selectedOrder && (
                    <div className="authenticated-modal-content">
                        <h3 className="authenticated-order-id">ID objednávky: {selectedOrder.id}</h3>
                        <p className="authenticated-order-summary">
                            <span>Celková cena:</span> {selectedOrder.total_price}
                            <span className="ml-4">Stav:</span> {selectedOrder.status}
                            <span className="ml-4">Způsob dopravy:</span> {selectedOrder.shipping_method}
                        </p>
                        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            {selectedOrder.products.map(product => (
                                <div key={product.id} className="authenticated-product">
                                    {product.image && (
                                        <img src={`/storage/${product.image}`} alt={product.name} className="authenticated-product-image" />
                                    )}
                                    <h4 className="authenticated-product-name">{product.name}</h4>
                                    <p className="authenticated-product-category">{product.category.name}</p>
                                    <p className="authenticated-product-details">
                                        <span>Množství:</span> {product.pivot.quantity}
                                        <span className="ml-4">Cena:</span> {product.pivot.price}
                                    </p>
                                </div>
                            ))}
                        </div>
                    </div>
                )}
            </Modal>
        </div>
    );
}
