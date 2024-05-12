import React, { useEffect } from 'react';
import { Head, Link } from '@inertiajs/react';

export default function OrderConfirmation() {
    useEffect(() => {
        // Vymazat položky košíku a data pokladny z localStorage
        localStorage.removeItem('cartItems');
        localStorage.removeItem('checkoutData');
    }, []);

    return (
        <>
            <Head title="Potvrzení objednávky" />
            <div className="container mx-auto px-4">
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
