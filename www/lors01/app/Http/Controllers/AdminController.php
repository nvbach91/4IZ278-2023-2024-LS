<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $orders = Order::with('products')->get();
        $categories = Category::all();

        return Inertia::render('AdminPage', compact('products', 'orders', 'categories'));
    }

    public function addProduct(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        Product::create($validatedData);

        return redirect()->route('admin.index')->with('success', 'Product added successfully.');
    }

    public function updateProduct(Request $request, $id)
    {
        \Illuminate\Support\Facades\Log::info("Updating product image with ID: {$id}");
        try {
            $product = Product::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
            ]);
    
            $product->update($validatedData);
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // Only separating the image update from the updateProduct worked. When I submit a form that includes both text data and a file, the request payload is sent in a multipart format. This means that the request is divided into multiple parts, each containing a specific piece of data. 
    public function updateProductImage(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Delete the old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
            $product->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }


        public function deleteProduct($id)
        {
            try {
                $product = Product::findOrFail($id);

                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }

                $product->delete();

                return Redirect::route('admin.index')->with('success', 'Product deleted successfully.');
            } catch (\Exception $e) {
                return Redirect::route('admin.index')->with('error', 'Chyba při odstraňování produktu: ' . $e->getMessage());
            }
        }

}
