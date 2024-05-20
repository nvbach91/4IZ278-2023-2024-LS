<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
    public function createCheckoutSession(Request $request)
    {

        $stripe = new StripeClient(config('services.stripe.secret_key'));
        $clientReferenceId = $request->user_id ?? uniqid('guest_');
        $customerEmail = $request->email;
    
        // Search for existing customer by email
        $existingCustomers = $stripe->customers->all(['email' => $customerEmail, 'limit' => 1]);
    
        if ($existingCustomers->data) {
            // Existing customer found
            $customer = $existingCustomers->data[0];
        } else {
            // No existing customer found, create new
            $customer = $stripe->customers->create([
                'email' => $customerEmail,
                'name' => "{$request->firstName} {$request->lastName}",
                'address' => [
                    'city' => $request->city,
                    'country' => $request->country,
                    'line1' => $request->address,
                    'postal_code' => $request->zip,
                ],
                'phone' => $request->phone,
            ]);
        }
    
        // Create checkout session
        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'customer' => $customer->id, // Use the existing customer with the address
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'czk',
                        'unit_amount' => $request->total * 100, // Amount in cents
                        'product_data' => [
                            'name' => 'Order Total',
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => url('/order-confirmation'),
            'cancel_url' => url('/payment'),
            'billing_address_collection' => 'auto',
            'client_reference_id' => $clientReferenceId,
            'metadata' => [
                'items' => json_encode(array_map(function ($item) {
                    return [
                        'id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ];
                }, $request->items)),
                'email' => $request->email,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'address' => $request->address,
                'city' => $request->city,
                'zip' => $request->zip,
                'company' => $request->company,
                'phone' => $request->phone,
                'country' => $request->country,
                'shipping_method' => $request->shipping_method,
                'payment_method' => $request->payment_method,
                'user_id' => $clientReferenceId,
            ],
        ]);

        return response()->json(['sessionId' => $session->id]);
    }
    

public function handleWebhook(Request $request)
{
    $payload = $request->getContent();
    $sigHeader = $request->header('Stripe-Signature');
    $endpoint_secret = config('services.stripe.webhook_secret');
    $event = null;

    try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sigHeader, $endpoint_secret
        );
    } catch (\UnexpectedValueException $e) {
        return response('', 400);
    } catch (\Stripe\Exception\SignatureVerificationException $e) {
        return response('', 400);
    }

    if ($event->type == 'checkout.session.completed') {
        $session = $event->data->object;


        $clientReferenceId = $session->client_reference_id;
        $email = $session->metadata->email;

        if (strpos($clientReferenceId, 'guest_') === 0) {
            // Guest user
            $userId = null;
        } else {
            // Logged-in user
            $userId = $clientReferenceId;
        }

        // Save the order with customer details and address
        $order = Order::create([
            'user_id' => $userId,
            'email' => $email,
            'first_name' => $session->metadata->first_name,
            'last_name' => $session->metadata->last_name,
            'address' => $session->metadata->address,
            'city' => $session->metadata->city,
            'zip' => $session->metadata->zip,
            'company' => $session->metadata->company,
            'phone' => $session->metadata->phone,
            'country' => $session->metadata->country,
            'shipping_method' => $session->metadata->shipping_method,
            'payment_method' => $session->metadata->payment_method,
            'total_price' => $session->amount_total / 100,
            'status' => 'paid',
        ]);

        $items = json_decode($session->metadata->items, true);

        foreach ($items as $item) {
            $order->products()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            // Update product stock
            $product = Product::find($item['id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }

        // Send order confirmation email
        Mail::to($email)->send(new OrderConfirmation($order));
    }

    return response('', 200);
}


}