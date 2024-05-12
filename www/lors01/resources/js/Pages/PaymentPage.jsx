import React, { useState, useEffect } from 'react';
import { Head, router } from '@inertiajs/react';
import { loadStripe } from '@stripe/stripe-js';

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
                address: checkoutData.address,
                firstName: checkoutData.firstName,
                lastName: checkoutData.lastName,
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
                address: checkoutData.address,
                firstName: checkoutData.firstName,
                lastName: checkoutData.lastName,
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
            <div className="container mx-auto px-4">
                <h1 className="text-2xl mb-4">Platba</h1>
                <div className="mb-4">
                    <h2 className="text-xl">Souhrn objednávky</h2>
                    {cartItems.map((item, index) => (
                        <div key={index} className="flex justify-between">
                            <div>{item.name} x {item.quantity}</div>
                            <div>{item.price * item.quantity} CZK</div>
                        </div>
                    ))}
                    <div className="mb-4">
                        <h3 className="text-lg">Způsob doručení</h3>
                        <div className={`border ${shippingMethodError ? 'border-red-500' : ''} p-2`}>
                            {shippingMethods.map((method) => (
                                <div key={method.id} className="flex items-center">
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
                                        className="mr-2"
                                    />
                                    <label htmlFor={method.id}>
                                        {method.name} - {method.price} CZK
                                    </label>
                                </div>
                            ))}
                        </div>
                    </div>
                    <div className="flex justify-between font-bold">
                        <div>Celkem</div>
                        <div>{calculateTotal()} CZK</div>
                    </div>
                </div>
                <div className="mb-4">
                    <button
                        onClick={handleCashPayment}
                        disabled={loading}
                        className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    >
                        {loading ? 'Zpracovává se...' : 'Zaplatit dobírkou'}
                    </button>
                </div>
                <div>
                    <button
                        onClick={handleStripePayment}
                        disabled={loading}
                        className="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded"
                    >
                        {loading ? 'Zpracovává se...' : 'Zaplatit kartou'}
                    </button>
                </div>
            </div>
        </>
    );
}
