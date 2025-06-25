<?php

// This controller handles CRUD operations (Create, Read, Update, Delete) for products.

namespace App\Http\Controllers; // This defines the namespace of this controller class.

use App\Models\Product; // Import the Product model to interact with the database.
use Illuminate\Http\Request; // Handles incoming HTTP requests (form input, query, etc.).
use Illuminate\Support\Facades\Validator; // Used for validating form data.
use Illuminate\Support\Facades\File; // Used to manage files (delete images, etc.).

class ProductController extends Controller // The controller extends base Controller class.
{
    /**
     * Show the list of products.
     */
    public function index()
    {
        // `Product::` uses scope resolution operator to call a static method from the Product model.
        // `orderBy('created_at', 'desc')` orders the products by latest first.
        // `get()` retrieves all matching records from the database.
        $products = Product::orderBy('created_at', 'desc')->get();

        // `view()` loads a Blade view and passes data to it as an associative array.
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form to create a new product.
     */
    public function create()
    {
        return view('products.create'); // Loads create product view.
    }

    /**
     * Save the new product to the database.
     */
    public function store(Request $request)
    {
        // Validate request inputs using Laravel Validator.
        $validator = Validator::make($request->all(), [ // `::make()` is a static method.
            'name' => 'required', // name field is required
            'sku' => 'required', // sku is required
            'price' => 'required|numeric', // price must be numeric
            'status' => 'required|in:Active,Inactive', // status must be either "Active" or "Inactive"
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // file must be an image with given types and max size 2MB
        ]);

        // If validation fails, redirect back to form with errors and old input
        if ($validator->fails()) { // `->` accesses the `fails()` method of the validator object
            return redirect()->route('products.create') // route() redirects to named route
                ->withErrors($validator) // sends validation errors
                ->withInput(); // keeps old form input
        }

        $imageName = null; // initialize image name to null

        // Check if an image was uploaded
        if ($request->hasFile('image')) { // `->hasFile()` checks if image field is uploaded
            $image = $request->image; // `->image` accesses the uploaded file

            // Generate unique filename: time() returns timestamp, `.` is string concatenation
            $imageName = time() . '.' . $image->getClientOriginalExtension(); 

            // Move the image to public/uploads/products/
            $image->move(public_path('uploads/products'), $imageName); 
        }

        // Create a new product and set values
        $product = new Product(); // new object of Product model

        $product->name = $request->name; // `->` accesses request input
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->image = $imageName; // image name or null

        $product->save(); // Save the product in the database

        return redirect()->route('products.index') // redirect to product list
            ->with('success', 'Product created successfully!'); // flash success message
    }

    /**
     * Display one specific product.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id); // Find product by ID or fail with 404
        return view('products.show', ['product' => $product]); // Load product detail view
    }

    /**
     * Show the form to edit a product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Fetch the product
        return view('products.edit', ['product' => $product]); // Show edit form
    }

    /**
     * Update the product data in the database.
     */
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id); // Get product to update
        $oldImage = $product->image; // Save current image name

        // Validate the input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|in:Active,Inactive',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // If validation fails, go back to edit form
        if ($validator->fails()) {
            return redirect()->route('products.edit', $product->id)
                ->withErrors($validator)
                ->withInput();
        }

        $imageName = null;

        // If new image uploaded
        if ($request->hasFile('image')) {
            // Check if old image exists AND file exists in path using `&&` (AND operator)
            if ($oldImage && file_exists(public_path('uploads/products/' . $oldImage))) {
                File::delete(public_path('uploads/products/' . $oldImage)); // delete old image file
            }

            $image = $request->image;
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // new filename
            $image->move(public_path('uploads/products'), $imageName); // upload image
        }

        // Update product fields
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;

        // Only update image if a new one was uploaded
        if ($imageName) {
            $product->image = $imageName;
        }

        $product->save(); // Save changes

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Delete a product from the database and remove its image.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id); // Find product

        // If image exists AND file is present, delete it
        if ($product->image && file_exists(public_path('uploads/products/' . $product->image))) {
            File::delete(public_path('uploads/products/' . $product->image)); // Delete image file
        }

        $product->delete(); // Delete product record

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
