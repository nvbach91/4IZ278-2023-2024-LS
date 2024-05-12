import React, { useEffect, useState } from 'react';
import { Head, useForm } from '@inertiajs/react';

export default function AdminPage({ products, orders, categories }) {
    const [editingProduct, setEditingProduct] = useState(null);
    const [editingProductImagePreview, setEditingProductImagePreview] = useState('');
    const [newProductImagePreview, setNewProductImagePreview] = useState('');

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

    const handleUpdateProduct = () => {
        put(route('admin.updateProduct', editingProduct.id), {
            onSuccess: () => {
                setEditingProduct(null);
                resetEditedProduct();
                setEditingProductImagePreview('');
                alert('Produkt úspěšně aktualizován.');
            },
            onError: () => {
                alert('Chyba při aktualizaci produktu.');
            }
        });
    };

    const handleDeleteProduct = (productId) => {
        if (confirm('Opravdu chcete tento produkt odstranit?')) {
            put(route('admin.deleteProduct', productId), {
                onSuccess: () => {
                    alert('Produkt úspěšně odstraněn.');
                },
                onError: () => {
                    alert('Chyba při odstraňování produktu.');
                }
            });
        };
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
            <div className="container mx-auto px-4">
                <h1 className="text-2xl mb-4">Administrátorský přehled</h1>

                <h2 className="text-xl mb-2">Produkty</h2>
                <table className="table-auto w-full mb-4">
                    <thead>
                        <tr>
                            <th className="px-4 py-2">Obrázek</th>
                            <th className="px-4 py-2">Název</th>
                            <th className="px-4 py-2">Popis</th>
                            <th className="px-4 py-2">Cena</th>
                            <th className="px-4 py-2">Sklad</th>
                        </tr>
                    </thead>
                    <tbody>
                        {products.map((product) => (
                            <tr key={product.id}>
                                <td className="border px-4 py-2">
                                    {product.image ? (
                                        <img
                                            src={`/storage/${product.image}`}
                                            alt={product.name}
                                            className="w-16 h-16 object-cover"
                                        />
                                    ) : (
                                        'Žádný obrázek'
                                    )}
                                </td>
                                <td className="border px-4 py-2">{product.name}</td>
                                <td className="border px-4 py-2">{product.description}</td>
                                <td className="border px-4 py-2">{product.price}</td>
                                <td className="border px-4 py-2">{product.stock}</td>
                                <td className="border px-4 py-2">
                                    <button
                                        className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mr-2"
                                        onClick={() => handleEditProduct(product)}
                                    >
                                        Upravit
                                    </button>
                                    <button
                                        className="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                        onClick={() => handleDeleteProduct(product.id)}
                                    >
                                        Smazat
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>

                <h3 className="text-lg mb-2">Přidat produkt</h3>
                <div className="mb-4">
                    <input
                        type="text"
                        name="name"
                        placeholder="Jméno"
                        value={newProduct.name}
                        onChange={(e) => setNewProduct('name', e.target.value)}
                        className="border rounded py-1 px-2 mr-2"
                    />
                    <input
                        type="text"
                        name="description"
                        placeholder="Popis"
                        value={newProduct.description}
                        onChange={(e) => setNewProduct('description', e.target.value)}
                        className="border rounded py-1 px-2 mr-2"
                    />
                    <input
                        type="number"
                        name="price"
                        placeholder="Cena"
                        value={newProduct.price}
                        onChange={(e) => setNewProduct('price', e.target.value)}
                        className="border rounded py-1 px-2 mr-2"
                    />
                    <input
                        type="number"
                        name="stock"
                        placeholder="Sklad"
                        value={newProduct.stock}
                        onChange={(e) => setNewProduct('stock', e.target.value)}
                        className="border rounded py-1 px-2 mr-2"
                    />

                    <select
                        name="category_id"
                        value={newProduct.category_id}
                        onChange={(e) => setNewProduct('category_id', e.target.value)}
                        className="border rounded py-1 px-2 mr-2"
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
                        className="bg-green-400 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2"
                        onClick={() => document.getElementById('newProductImage').click()}
                    >
                        Vyberte obrázek
                    </button>

                    <input
                        type="file"
                        id="newProductImage"
                        name="image"
                        accept="image/*"
                        className="hidden"
                        onChange={handleNewProductImageChange}
                    />
                    {newProductImagePreview && (
                        <img
                            src={newProductImagePreview}
                            alt="Náhled"
                            className="w-16 h-16 object-cover mb-2"
                        />
                    )}
                    <button
                        className="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded"
                        onClick={handleAddProduct}
                        disabled={addProcessing}
                    >
                        {addProcessing ? 'Přidává se...' : 'Přidat'}
                    </button>
                </div>

                {editingProduct && (
                    <div className="mb-4">
                        <h3 className="text-lg mb-2">Upravit produkt</h3>
                        {editingProductImagePreview && (
                            <img
                                src={editingProductImagePreview}
                                alt="Náhled"
                                className="w-16 h-16 object-cover mb-2"
                            />
                        )}
                        <input
                            type="text"
                            name="name"
                            placeholder="Jméno"
                            value={editedProduct.name}
                            onChange={(e) => setEditedProduct('name', e.target.value)}
                            className="border rounded py-1 px-2 mr-2"
                        />
                        <input
                            type="text"
                            name="description"
                            placeholder="Popis"
                            value={editedProduct.description}
                            onChange={(e) => setEditedProduct('description', e.target.value)}
                            className="border rounded py-1 px-2 mr-2"
                        />
                        <input
                            type="number"
                            name="price"
                            placeholder="Cena"
                            value={editedProduct.price}
                            onChange={(e) => setEditedProduct('price', e.target.value)}
                            className="border rounded py-1 px-2 mr-2"
                        />
                        <input
                            type="number"
                            name="stock"
                            placeholder="Sklad"
                            value={editedProduct.stock}
                            onChange={(e) => setEditedProduct('stock', e.target.value)}
                            className="border rounded py-1 px-2 mr-2"
                        />
                        <select
                            name="category_id"
                            value={editedProduct.category_id}
                            onChange={(e) => setEditedProduct('category_id', e.target.value)}
                            className="border rounded py-1 px-2 mr-2"
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
                            className="bg-green-400 hover:bg-green-700 text-white font-bold py-1 px-2 rounded mr-2"
                            onClick={() => document.getElementById('editedProductImage').click()}
                        >
                            Vyberte obrázek
                        </button>
                        <input
                            type="file"
                            id="editedProductImage"
                            name="image"
                            accept="image/*"
                            className="hidden"
                            onChange={handleEditedProductImageChange}
                        />
                        <button
                            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"
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
