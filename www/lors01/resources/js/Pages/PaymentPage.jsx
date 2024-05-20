import React, { useState, useEffect } from 'react';
import { Head, router } from '@inertiajs/react';
import { loadStripe } from '@stripe/stripe-js';
import '../../css/paymentPage.css';

const stripePromise = loadStripe('pk_test_51N7d6TGb9oIEuaf3cHUvqvYoIuTABOVGqO9QcARE0DrX6dubs4bDdQnpJ5pQB0lXZrktS2SwOIUVVV5LDuxaopKJ00RDMJBtnd');

export default function PaymentPage({ auth }) {
    const [cartItems, setCartItems] = useState([]);
    const [checkoutData, setCheckoutData] = useState({});
    const [loading, setLoading] = useState(false);
    const [selectedShippingMethod, setSelectedShippingMethod] = useState(null);
    const [shippingMethodError, setShippingMethodError] = useState(false);

    const shippingMethods = [
        { id: 'ppl', name: 'PPL', price: 100 },
        { id: 'dpd', name: 'DPD', price: 120 },
    ];

    useEffect(() => {
        const items = JSON.parse(localStorage.getItem('cartItems')) || [];
        const data = JSON.parse(localStorage.getItem('checkoutData')) || {};
        setCartItems(items);
        setCheckoutData(data);
    }, []);

    const handleCashPayment = async () => {
        if (!selectedShippingMethod) {
            setShippingMethodError(true);
            return;
        }
        setLoading(true);
        try {
            const response = await axios.post('/orders', {
                user_id: auth.user ? auth.user.id : null,
                items: cartItems,
                total: calculateTotal(),
                email: checkoutData.email,
                firstName: checkoutData.firstName,
                lastName: checkoutData.lastName,
                address: checkoutData.address,
                company: checkoutData.company,
                city: checkoutData.city,
                zip: checkoutData.zip,
                phone: checkoutData.phone,
                country: checkoutData.country,
                shipping_method: selectedShippingMethod.name,
                payment_method: "dobirka",
            });
            localStorage.removeItem('cartItems');
            localStorage.removeItem('checkoutData');
            router.visit('/order-confirmation');
        } catch (error) {
            console.error('Chyba při vytváření objednávky:', error);
        }
        setLoading(false);
    };

    const handleStripePayment = async () => {
        if (!selectedShippingMethod) {
            setShippingMethodError(true);
            return;
        }
        setLoading(true);
        const stripe = await stripePromise;
        try {
            const response = await axios.post('/create-checkout-session', {
                user_id: auth.user ? auth.user.id : null,
                items: cartItems,
                total: calculateTotal(),
                email: checkoutData.email,
                firstName: checkoutData.firstName,
                lastName: checkoutData.lastName,
                address: checkoutData.address,
                company: checkoutData.company,
                city: checkoutData.city,
                zip: checkoutData.zip,
                phone: checkoutData.phone,
                country: checkoutData.country,
                shipping_method: selectedShippingMethod.name,
                payment_method: "kartou",
            });
            const { sessionId } = response.data;
            const result = await stripe.redirectToCheckout({ sessionId });
            if (result.error) {
                console.error('Chyba při Stripe platbě:', result.error);
            }
        } catch (error) {
            console.error('Chyba při vytváření Stripe platební relace:', error);
        }
        setLoading(false);
    };

    const calculateTotal = () => {
        const itemsTotal = cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
        const shippingPrice = selectedShippingMethod ? selectedShippingMethod.price : 0;
        return itemsTotal + shippingPrice;
    };

    return (
        <>
            <Head title="Platba" />
            <div className="payment-container">
                <h1 className="payment-title">Platba</h1>
                <div className="payment-summary">
                    <h2 className="payment-subtitle">Souhrn objednávky</h2>
                    {cartItems.map((item, index) => (
                        <div key={index} className="payment-item">
                            <div>{item.name} x {item.quantity}</div>
                            <div>{item.price * item.quantity} CZK</div>
                        </div>
                    ))}
                    <div className="payment-shipping-method">
                        <h3 className="payment-shipping-title">Způsob doručení</h3>
                        <div className={`payment-shipping-options ${shippingMethodError ? 'payment-shipping-error' : ''}`}>
                            {shippingMethods.map((method) => (
                                <div key={method.id} className="payment-shipping-option">
                                    <input
                                        type="radio"
                                        id={method.id}
                                        name="shippingMethod"
                                        value={method.id}
                                        checked={selectedShippingMethod?.id === method.id}
                                        onChange={() => {
                                            setSelectedShippingMethod(method);
                                            setShippingMethodError(false);
                                        }}
                                        className="payment-radio"
                                    />
                                    <label htmlFor={method.id}>
                                        {method.name} - {method.price} CZK
                                    </label>
                                </div>
                            ))}
                        </div>
                    </div>
                    <div className="payment-total">
                        <div>Celkem</div>
                        <div>{calculateTotal()} CZK</div>
                    </div>
                </div>
                <div className="payment-button-container">
                    <button
                        onClick={handleCashPayment}
                        disabled={loading}
                        className="payment-button payment-cash-button"
                    >
                        {loading ? 'Zpracovává se...' : 'Zaplatit dobírkou'}
                    </button>
                </div>
                <div className="payment-button-container">
                    <button
                        onClick={handleStripePayment}
                        disabled={loading}
                        className="payment-button payment-stripe-button"
                    >
                        {loading ? 'Zpracovává se...' : 'Zaplatit kartou'}
                    </button>
                </div>
            </div>
        </>
    );
}
