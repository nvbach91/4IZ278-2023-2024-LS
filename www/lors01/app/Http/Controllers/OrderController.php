<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $userEmail = $request->user()->email;
        $orders = Order::where('email', $userEmail)
            ->with(['products' => function ($query) {
                $query->with('category');
            }])
            ->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
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
            'total_price' => $request->total,
            'status' => 'pending',
        ]);

        foreach ($request->items as $item) {
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
        Mail::to($request->email)->send(new OrderConfirmation($order));

       return response()->json(['message' => 'Order created successfully']);
   }
}