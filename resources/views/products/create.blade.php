<!doctype html>
<html lang="en">
  <head>
    <!-- Character encoding -->
    <meta charset="utf-8">

    <!-- Responsive meta tag -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page title -->
    <title>Laravel12 CRUD</title>

    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
          crossorigin="anonymous">
  </head>

  <body>
    <!-- Header bar with title -->
    <div class="bg-dark text-center text-white py-3">
        <h1 class="h2">Laravel 12 CRUD Application</h1>   
    </div>

    <div class="container">
        <div class="row">
            
            <!-- Back button to go to product listing page -->
            <div class="d-flex justify-content-end p-0 mt-3">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
            </div>

            <!-- Card for the form -->
            <div class="card p-0 m-3">
                <div class="card-header bg-dark text-white">
                    <h4 class="h4">Create Product</h4>
                </div>

                <div class="card-body shadow-lg">
                    <!-- Form starts -->
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        
                        {{-- @csrf is required for form security --}}
                        @csrf

                        <!-- Product Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   placeholder="Name">
                            @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Product Image Input -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file"
                                   class="form-control @error('image') is-invalid @enderror"
                                   id="image"
                                   name="image">
                            @error('image')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SKU Input -->
                        <div class="mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text"
                                   class="form-control @error('sku') is-invalid @enderror"
                                   id="sku"
                                   name="sku"
                                   placeholder="SKU">
                            @error('sku')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price Input -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text"
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
                                <option value="">Select status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            @error('status')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </form>
                    <!-- End of Form -->
                </div>
            </div>

        </div> <!-- end row -->
    </div> <!-- end container -->

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
  </body>
</html>
