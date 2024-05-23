import React, { useEffect, useState } from 'react';
import { Head, useForm, router, Link } from '@inertiajs/react';
import axios from 'axios';
import '../../css/adminPage.css';
import Dropdown from '@/Components/Dropdown';
import ApplicationLogo from '@/Components/ApplicationLogo';
import NavLink from '@/Components/NavLink';

export default function AdminPage({ auth, products, orders, categories }) {
    const [editingProduct, setEditingProduct] = useState(null);
    const [editingProductImagePreview, setEditingProductImagePreview] = useState('');
    const [newProductImagePreview, setNewProductImagePreview] = useState('');
    const [cartItems, setCartItems] = useState([]);
    const [isActive, setIsActive] = useState(false);

    const handleToggle = () => {
        setIsActive(!isActive);
    };
    
    // New Product Form
    const { data: newProduct, setData: setNewProduct, post, processing: addProcessing, reset: resetNewProduct } = useForm({
        name: '',
        description: '',
        price: '',
        stock: '',
        category_id: '',
        image: null,
    });

    const handleAddProduct = () => {
        post(route('admin.addProduct'), {
            onSuccess: () => {
                resetNewProduct();
                setNewProductImagePreview('');
                alert('Produkt úspěšně přidán.');
            },
            onError: () => {
                alert('Chyba při přidávání produktu.');
            }
        });
    };

    // Edited Product Form
    const { data: editedProduct, setData: setEditedProduct, put, processing: updateProcessing, reset: resetEditedProduct } = useForm({
        name: '',
        description: '',
        price: '',
        stock: '',
        category_id: '',
        image: null,
    });

    useEffect(() => {
        if (editingProduct) {
            setEditedProduct({
                name: editingProduct.name,
                description: editingProduct.description,
                price: editingProduct.price,
                stock: editingProduct.stock,
                category_id: editingProduct.category_id,
                image: editingProduct.image,
            });
            setEditingProductImagePreview(editingProduct.image ? `/storage/${editingProduct.image}` : '');
        } else {
            resetEditedProduct();
        }
    }, [editingProduct]);

    const handleEditProduct = (product) => {
        setEditingProduct(product);
    };

    const handleUpdateProduct = async () => {
        try {
            // Update product data without the image
            await axios.put(route('admin.updateProduct', editingProduct.id), {
                name: editedProduct.name,
                description: editedProduct.description,
                price: editedProduct.price,
                stock: editedProduct.stock,
                category_id: editedProduct.category_id,
            });

            // Update the image separately if a new image is selected
            if (editedProduct.image instanceof File) {
                const formData = new FormData();
                formData.append('image', editedProduct.image);

                await axios.post(route('admin.updateProductImage', editingProduct.id), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
            }

            setEditingProduct(null);
            resetEditedProduct();
            setEditingProductImagePreview('');
            alert('Produkt úspěšně aktualizován.');
        } catch (error) {
            console.error('Chyba při aktualizaci produktu:', error);
            alert('Chyba při aktualizaci produktu.');
        }
    };

    const handleDeleteProduct = (productId) => {
        if (confirm('Opravdu chcete tento produkt odstranit?')) {
            put(route('admin.deleteProduct', productId), {
                onSuccess: () => {
                    setEditingProduct(null);
                    resetEditedProduct();
                    setEditingProductImagePreview('');
                    alert('Produkt úspěšně smazán.');
                },
                onError: () => {
                    alert('Chyba při odstraňování produktu.');
                }
            });
        }
    };

    const handleNewProductImageChange = (e) => {
        const file = e.target.files[0];
        setNewProduct('image', file);
        setNewProductImagePreview(URL.createObjectURL(file));
    };

    const handleEditedProductImageChange = (e) => {
        const file = e.target.files[0];
        setEditedProduct('image', file);
        setEditingProductImagePreview(URL.createObjectURL(file));
    };

    return (
        <>
            <Head title="Administrátorský přehled" />
            <div className="admin-container">
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
                <h1 className="admin-title">Administrátorský přehled</h1>

                <h2 className="admin-subtitle">Produkty</h2>
                <table className="admin-table">
                    <thead>
                        <tr>
                            <th className="admin-table-header">Obrázek</th>
                            <th className="admin-table-header">Název</th>
                            <th className="admin-table-header">Popis</th>
                            <th className="admin-table-header">Cena</th>
                            <th className="admin-table-header">Sklad</th>
                            <th className="admin-table-header">Akce</th>
                        </tr>
                    </thead>
                    <tbody>
                        {products.map((product) => (
                            <tr key={product.id} className="admin-table-row">
                                <td className="admin-table-cell">
                                    {product.image ? (
                                        <img
                                            src={`/storage/${product.image}`}
                                            alt={product.name}
                                            className="admin-product-image"
                                        />
                                    ) : (
                                        'Žádný obrázek'
                                    )}
                                </td>
                                <td className="admin-table-cell">{product.name}</td>
                                <td className="admin-table-cell">{product.description}</td>
                                <td className="admin-table-cell">{product.price}</td>
                                <td className="admin-table-cell">{product.stock}</td>
                                <td className="admin-table-cell">
                                    <button
                                        className="admin-button admin-button-edit"
                                        onClick={() => handleEditProduct(product)}
                                    >
                                        Upravit
                                    </button>
                                    <button
                                        className="admin-button admin-button-delete"
                                        onClick={() => handleDeleteProduct(product.id)}
                                    >
                                        Smazat
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>

                <h3 className="admin-form-title">Přidat produkt</h3>
                <div className="admin-form">
                    <input
                        type="text"
                        name="name"
                        placeholder="Jméno"
                        value={newProduct.name}
                        onChange={(e) => setNewProduct('name', e.target.value)}
                        className="admin-input"
                    />
                    <input
                        type="text"
                        name="description"
                        placeholder="Popis"
                        value={newProduct.description}
                        onChange={(e) => setNewProduct('description', e.target.value)}
                        className="admin-input"
                    />
                    <input
                        type="number"
                        name="price"
                        placeholder="Cena"
                        value={newProduct.price}
                        onChange={(e) => setNewProduct('price', e.target.value)}
                        className="admin-input"
                    />
                    <input
                        type="number"
                        name="stock"
                        placeholder="Sklad"
                        value={newProduct.stock}
                        onChange={(e) => setNewProduct('stock', e.target.value)}
                        className="admin-input"
                    />
                    <select
                        name="category_id"
                        value={newProduct.category_id}
                        onChange={(e) => setNewProduct('category_id', e.target.value)}
                        className="admin-select"
                    >
                        <option value="">Vybrat kategorii</option>
                        {categories.map((category) => (
                            <option key={category.id} value={category.id}>
                                {category.name}
                            </option>
                        ))}
                    </select>
                    <button
                        type="button"
                        className="admin-button admin-button-upload"
                        onClick={() => document.getElementById('newProductImage').click()}
                    >
                        Vyberte obrázek
                    </button>
                    <input
                        type="file"
                        id="newProductImage"
                        name="image"
                        accept="image/*"
                        className="admin-input-file"
                        onChange={handleNewProductImageChange}
                    />
                    {newProductImagePreview && (
                        <img
                            src={newProductImagePreview}
                            alt="Náhled"
                            className="admin-image-preview"
                        />
                    )}
                    <button
                        className="admin-button admin-button-add"
                        onClick={handleAddProduct}
                        disabled={addProcessing}
                    >
                        {addProcessing ? 'Přidává se...' : 'Přidat'}
                    </button>
                </div>

                {editingProduct && (
                    <div className="admin-form">
                        <h3 className="admin-form-title">Upravit produkt</h3>
                        {editingProductImagePreview && (
                            <img
                                src={editingProductImagePreview}
                                alt="Náhled"
                                className="admin-image-preview"
                            />
                        )}
                        <input
                            type="text"
                            name="name"
                            placeholder="Jméno"
                            value={editedProduct.name}
                            onChange={(e) => setEditedProduct('name', e.target.value)}
                            className="admin-input"
                        />
                        <input
                            type="text"
                            name="description"
                            placeholder="Popis"
                            value={editedProduct.description}
                            onChange={(e) => setEditedProduct('description', e.target.value)}
                            className="admin-input"
                        />
                        <input
                            type="number"
                            name="price"
                            placeholder="Cena"
                            value={editedProduct.price}
                            onChange={(e) => setEditedProduct('price', e.target.value)}
                            className="admin-input"
                        />
                        <input
                            type="number"
                            name="stock"
                            placeholder="Sklad"
                            value={editedProduct.stock}
                            onChange={(e) => setEditedProduct('stock', e.target.value)}
                            className="admin-input"
                        />
                        <select
                            name="category_id"
                            value={editedProduct.category_id}
                            onChange={(e) => setEditedProduct('category_id', e.target.value)}
                            className="admin-select"
                        >
                            <option value="">Vybrat kategorii</option>
                            {categories.map((category) => (
                                <option key={category.id} value={category.id}>
                                    {category.name}
                                </option>
                            ))}
                        </select>
                        <button
                            type="button"
                            className="admin-button admin-button-upload"
                            onClick={() => document.getElementById('editedProductImage').click()}
                        >
                            Vyberte obrázek
                        </button>
                        <input
                            type="file"
                            id="editedProductImage"
                            name="image"
                            accept="image/*"
                            className="admin-input-file"
                            onChange={handleEditedProductImageChange}
                        />
                        <button
                            className="admin-button admin-button-update"
                            onClick={handleUpdateProduct}
                            disabled={updateProcessing}
                        >
                            {updateProcessing ? 'Aktualizuje se...' : 'Aktualizovat'}
                        </button>
                    </div>
                )}
            </div>
        </>
    );
}
