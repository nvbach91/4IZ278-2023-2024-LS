import React, { useState, useEffect } from 'react';
import { Head, router } from '@inertiajs/react';

export default function CheckoutPage() {
    const defaultFormData = {
        email: '',
        country: 'CZ',
        firstName: '',
        lastName: '',
        company: '',
        address: '',
        city: '',
        zip: '',
        phone: ''
    };

    const [cartItems, setCartItems] = useState([]);
    const [formData, setFormData] = useState(defaultFormData);
    const [errors, setErrors] = useState({});

    useEffect(() => {
        const storedFormData = JSON.parse(localStorage.getItem('checkoutData'));
        const items = JSON.parse(localStorage.getItem('cartItems')) || [];
        setCartItems(items);
        if (storedFormData) {
            setFormData(storedFormData);
        }
    }, []);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
        // Vymazat chyby při změně vstupu
        if (errors[name]) {
            setErrors({ ...errors, [name]: null });
        }
    };

    const validateForm = () => {
        const newErrors = {};
        // Povinná pole
        ['email', 'firstName', 'lastName', 'address', 'city', 'zip', 'phone'].forEach(field => {
            if (!formData[field]) {
                newErrors[field] = 'Toto pole je povinné';
            }
        });
        // Formát e-mailu
        if (formData.email && !/\S+@\S+\.\S+/.test(formData.email)) {
            newErrors.email = 'E-mailová adresa není platná';
        }
        // Telefonní číslo může obsahovat pouze čísla
        if (formData.phone && !/^\d+$/.test(formData.phone)) {
            newErrors.phone = 'Telefonní číslo musí být číselné';
        }
        // Kontrola poštovního směrovacího čísla
        if (formData.zip && (!/^\d{5}$/.test(formData.zip))) {
            newErrors.zip = 'PSČ musí být přesně 5 číslic';
        }
        return newErrors;
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const validationErrors = validateForm();
        if (Object.keys(validationErrors).length > 0) {
            setErrors(validationErrors);
            return;
        }
        localStorage.setItem('checkoutData', JSON.stringify(formData));
        router.visit('/payment'); 
    };

    return (
        <>
            <Head title="Pokladna" />
            <div className="container mx-auto px-4">
                <h1 className="text-2xl mb-4">Pokladna</h1>
                <div className="flex flex-wrap md:flex-nowrap">
                    <div className="w-full md:w-2/3 p-5">
                        {cartItems.map((product, index) => (
                            <div key={index} className="mb-4 flex items-center">
                                <img src={`/storage/${product.image}`} alt={product.name} className="w-20 h-20 mr-4" />
                                <div>
                                    <h5 className="text-lg font-semibold">{product.name}</h5>
                                    <p>{product.quantity} x {product.price} CZK</p>
                                </div>
                            </div>
                        ))}
                    </div>
                    <div className="w-full md:w-1/3 p-5 bg-gray-100">
                        <form onSubmit={handleSubmit} className="space-y-4">
                            <input
                                type="email"
                                name="email"
                                value={formData.email}
                                onChange={handleChange}
                                placeholder="E-mail"
                                className={`w-full px-4 py-2 border rounded-md ${errors.email ? 'border-red-500' : ''}`}
                            />
                            {errors.email && <p className="text-red-500 text-xs italic">{errors.email}</p>}
                            <select
                                name="country"
                                value={formData.country}
                                onChange={handleChange}
                                className="w-full px-4 py-2 border rounded-md"
                            >
                                <option value="CZ">Česká republika</option>
                                <option value="SK">Slovensko</option>
                                <option value="DE">Německo</option>
                                <option value="PL">Polsko</option>
                            </select>
                            <input
                                type="text"
                                name="firstName"
                                value={formData.firstName}
                                onChange={handleChange}
                                placeholder="Jméno"
                                className={`w-full px-4 py-2 border rounded-md ${errors.firstName ? 'border-red-500' : ''}`}
                            />
                            {errors.firstName && <p className="text-red-500 text-xs italic">{errors.firstName}</p>}
                            <input
                                type="text"
                                name="lastName"
                                value={formData.lastName}
                                onChange={handleChange}
                                placeholder="Příjmení"
                                className={`w-full px-4 py-2 border rounded-md ${errors.lastName ? 'border-red-500' : ''}`}
                            />
                            {errors.lastName && <p className="text-red-500 text-xs italic">{errors.lastName}</p>}
                            <input
                                type="text"
                                name="company"
                                value={formData.company}
                                onChange={handleChange}
                                placeholder="Firma (volitelně)"
                                className="w-full px-4 py-2 border rounded-md"
                            />
                            <input
                                type="text"
                                name="address"
                                value={formData.address}
                                onChange={handleChange}
                                placeholder="Adresa"
                                className={`w-full px-4 py-2 border rounded-md ${errors.address ? 'border-red-500' : ''}`}
                            />
                            {errors.address && <p className="text-red-500 text-xs italic">{errors.address}</p>}
                            <input
                                type="text"
                                name="city"
                                value={formData.city}
                                onChange={handleChange}
                                placeholder="Město"
                                className={`w-full px-4 py-2 border rounded-md ${errors.city ? 'border-red-500' : ''}`}
                            />
                            {errors.city && <p className="text-red-500 text-xs italic">{errors.city}</p>}
                            <input
                                type="text"
                                name="zip"
                                value={formData.zip}
                                onChange={handleChange}
                                placeholder="PSČ"
                                className={`w-full px-4 py-2 border rounded-md ${errors.zip ? 'border-red-500' : ''}`}
                            />
                            {errors.zip && <p className="text-red-500 text-xs italic">{errors.zip}</p>}
                            <input
                                type="phone"
                                name="phone"
                                value={formData.phone}
                                onChange={handleChange}
                                placeholder="Telefon"
                                className={`w-full px-4 py-2 border rounded-md ${errors.phone ? 'border-red-500' : ''}`}
                            />
                            {errors.phone && <p className="text-red-500 text-xs italic">{errors.phone}</p>}
                            <button
                                type="submit"
                                className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Pokračovat k platbě
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </>
    );
}
