<!doctype html>
<html lang="en">
  <head>
    <!-- Character encoding -->
    <meta charset="utf-8">

    <!-- Responsive design meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page title -->
    <title>Laravel12 CRUD</title>

    <!-- Bootstrap 5 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    <!-- Page banner/header -->
    <div class="bg-dark text-center text-white py-3">
        <h1 class="h2">Laravel 12 CRUD Application</h1>   
    </div>

    <div class="container">
        <div class="row">
            <!-- Back button aligned to right -->
            <div class="d-flex justify-content-end p-0 mt-3">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
            </div> 

            <!-- Card UI box -->
            <div class="card p-0 m-3">
                <div class="card-header bg-dark text-white">
                    <h4 class="h4">Edit Product</h4>
                </div>

                <div class="card-body shadow-lg">
                    <!-- Form to update product -->
                    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf <!-- CSRF token for form security -->
                        @method('PUT') <!-- HTML forms don't support PUT, so we spoof it -->

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ old('name', $product->name) }}" 
                                   type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Name">
                            @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Show current image if available -->
                        @if ($product->image)
                        <div class="mb-3">
                            <label class="form-label d-block">Current Image:</label>
                            <img class="rounded mb-2" src="{{ asset('uploads/products/' . $product->image) }}" width="80">
                        </div>
                        @endif

                        <!-- New Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload New Image</label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image">
                            @error('image')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SKU Field -->
                        <div class="mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input value="{{ old('sku', $product->sku) }}" 
                                   type="text" 
                                   class="form-control @error('sku') is-invalid @enderror" 
                                   id="sku" 
                                   name="sku" 
                                   placeholder="SKU">
                            @error('sku')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price Field -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input value="{{ old('price', $product->price) }}" 
                                   type="text" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   id="price" 
                                   name="price" 
                                   placeholder="Price">
                            @error('price')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Dropdown -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status">
                                <!-- If status is 'Active', mark it as selected -->
                                <option {{ $product->status === 'Active' ? 'selected' : '' }} value="Active">Active</option>
                                <option {{ $product->status === 'Inactive' ? 'selected' : '' }} value="Inactive">Inactive</option>
                            </select>
                            @error('status')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror   
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-dark">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS for alerts, dropdowns, etc. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
