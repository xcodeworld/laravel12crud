<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
// -----------------------------------------------------------------------------
// Route 2: Product List (Index)
// -----------------------------------------------------------------------------

// GET method – used to retrieve a list of products
// '/products' – the URL path
// [ProductController::class, 'index'] – calls the index() method from ProductController
// ::class – PHP's scope resolution operator returns full class name
// 'index' – name of the method to handle this request
// ->name('products.index') – gives this route a name for referencing in views or redirects
Route::get('/products', [ProductController::class, 'index'])->name('products.index');


// -----------------------------------------------------------------------------
// Route 3: Product Create Form
// -----------------------------------------------------------------------------

// GET method – displays a form for creating a new product
// '/products/create' – URL path
// 'create' method in ProductController shows the HTML form
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');


// -----------------------------------------------------------------------------
// Route 4: Store New Product
// -----------------------------------------------------------------------------

// POST method – submits form data to save a new product
// '/products' – form action submits to this path
// 'store' method handles validation and saving logic
Route::post('/products', [ProductController::class, 'store'])->name('products.store');


// -----------------------------------------------------------------------------
// Route 5: Edit Form for Existing Product
// -----------------------------------------------------------------------------

// GET method – fetches a form for editing a product
// '/products/{product}/edit' – dynamic route with placeholder `{product}`
// {} – curly braces mean a route parameter; Laravel will auto-inject a Product model
// 'edit' method returns the edit form
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');


// -----------------------------------------------------------------------------
// Route 6: Update Existing Product
// -----------------------------------------------------------------------------

// PUT method – used to send updated data (from form) for the product
// '/products/{product}' – URL includes product ID to identify which product to update
// 'update' method handles validation and updating logic
// ->name(...) – allows easy reference in forms like: route('products.update', $product->id)
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');


// -----------------------------------------------------------------------------
// Route 7: Delete a Product
// -----------------------------------------------------------------------------

// DELETE method – deletes the product from the database
// '/products/{product}' – again, the product is identified by the {product} ID
// 'destroy' method deletes the record and the image if exists
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
