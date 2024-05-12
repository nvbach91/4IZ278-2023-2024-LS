<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $orders = Order::with('products')->get();
        $categories = Category::all(); // Fetch all categories

        return Inertia::render('AdminPage', compact('products', 'orders', 'categories')); // Pass categories
    }

    public function addProduct(Request $request)
    {
        // Validate product data and the image file
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Add this line for image validation
        ]);
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // Save to 'public/products' directory
            $validatedData['image'] = $imagePath;
        }
    
        Product::create($validatedData);
    
        return redirect()->route('admin.index')->with('success', 'Product added successfully.');
    }
    
    
    public function updateProduct(Request $request, $id)
    {
        // Validate product data and the image file
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Find the product by ID
        $product = Product::findOrFail($id);
    
        // Handle the image update
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        $product->update($validatedData);
    
        return redirect()->route('admin.index')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);
    
        // Check if the product has an associated image
        if ($product->image) {
            // Construct the full path to the image file
            $imagePath = storage_path('app/public/' . $product->image);
    
            // Check if the file exists, then delete it
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        // Delete the product from the database
        $product->delete();
    
        return redirect()->route('admin.index')->with('success', 'Product deleted successfully.');
    }
    
}