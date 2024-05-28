import React, { useState, useEffect } from 'react';
import { Head, router } from '@inertiajs/react';
import axios from 'axios';
import '../../css/checkoutPage.css';

export default function CheckoutPage({ auth }) {
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
        } else if (auth.user) {
            // Extract first and last name from the full name
            const [firstName, lastName] = auth.user.name.split(' ');
            // Prefill form with user data if logged in
            setFormData({
                email: auth.user.email || '',
                country: 'CZ',
                firstName: firstName || '',
                lastName: lastName || '',
            });
        }
    }, [auth.user]);

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
        // Clear errors on input change
        if (errors[name]) {
            setErrors({ ...errors, [name]: null });
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        axios.post('/validate-checkout', formData)
            .then(response => {
                localStorage.setItem('checkoutData', JSON.stringify(formData));
                router.visit('/payment');
            })
            .catch(error => {
                if (error.response && error.response.data.errors) {
                    setErrors(error.response.data.errors);
                }
            });
    };

    return (
        <>
            <Head title="Pokladna" />
            <div className="checkout-container">
                <h1 className="checkout-title">Pokladna</h1>
                <div className="checkout-content">
                    <div className="checkout-cart-items">
                        {cartItems.map((product, index) => (
                            <div key={index} className="checkout-cart-item">
                                <img src={`/storage/${product.image}`} alt={product.name} className="checkout-cart-item-image" />
                                <div>
                                    <h5 className="checkout-cart-item-name">{product.name}</h5>
                                    <p>{product.quantity} x {product.price} CZK</p>
                                </div>
                            </div>
                        ))}
                    </div>
                    <div className="checkout-form">
                        <form onSubmit={handleSubmit} className="checkout-form-fields">
                            <input
                                type="email"
                                name="email"
                                value={formData.email}
                                onChange={handleChange}
                                placeholder="E-mail"
                                className={`checkout-input ${errors.email ? 'checkout-input-error' : ''}`}
                            />
                            {errors.email && <p className="checkout-error">{errors.email}</p>}
                            <select
                                name="country"
                                value={formData.country}
                                onChange={handleChange}
                                className="checkout-input"
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
                                className={`checkout-input ${errors.firstName ? 'checkout-input-error' : ''}`}
                            />
                            {errors.firstName && <p className="checkout-error">{errors.firstName}</p>}
                            <input
                                type="text"
                                name="lastName"
                                value={formData.lastName}
                                onChange={handleChange}
                                placeholder="Příjmení"
                                className={`checkout-input ${errors.lastName ? 'checkout-input-error' : ''}`}
                            />
                            {errors.lastName && <p className="checkout-error">{errors.lastName}</p>}
                            <input
                                type="text"
                                name="company"
                                value={formData.company}
                                onChange={handleChange}
                                placeholder="Firma (volitelně)"
                                className="checkout-input"
                            />
                            <input
                                type="text"
                                name="address"
                                value={formData.address}
                                onChange={handleChange}
                                placeholder="Adresa"
                                className={`checkout-input ${errors.address ? 'checkout-input-error' : ''}`}
                            />
                            {errors.address && <p className="checkout-error">{errors.address}</p>}
                            <input
                                type="text"
                                name="city"
                                value={formData.city}
                                onChange={handleChange}
                                placeholder="Město"
                                className={`checkout-input ${errors.city ? 'checkout-input-error' : ''}`}
                            />
                            {errors.city && <p className="checkout-error">{errors.city}</p>}
                            <input
                                type="text"
                                name="zip"
                                value={formData.zip}
                                onChange={handleChange}
                                placeholder="PSČ"
                                className={`checkout-input ${errors.zip ? 'checkout-input-error' : ''}`}
                            />
                            {errors.zip && <p className="checkout-error">{errors.zip}</p>}
                            <input
                                type="phone"
                                name="phone"
                                value={formData.phone}
                                onChange={handleChange}
                                placeholder="Telefon"
                                className={`checkout-input ${errors.phone ? 'checkout-input-error' : ''}`}
                            />
                            {errors.phone && <p className="checkout-error">{errors.phone}</p>}
                            <button
                                type="submit"
                                className="checkout-submit-button"
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
