<!doctype html>
<html lang="en">
  <head>
    <!-- Sets the character encoding to UTF-8 -->
    <meta charset="utf-8">

    <!-- Makes the page responsive on all screen sizes -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page title shown in browser tab -->
    <title>Laravel12 CRUD</title>

    <!-- Load Bootstrap 5 from CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
    
    <!-- Dark top banner with title -->
    <div class="bg-dark text-center text-white py-3">
        <!-- h1 with Bootstrap size h2 -->
        <h1 class="h2">Laravel 12 CRUD Application</h1>   
    </div>

    <div class="container"> <!-- Bootstrap container -->
        <div class="row">
            
            <!-- "Create" button aligned to the right -->
            <div class="d-flex justify-content-end p-0 mt-3">
                <!-- route('products.create') returns URL for the create page -->
                <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
            </div> 

            {{-- ✅ Display success message if set in session --}}
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <!-- Show the success message -->
                    {{ Session::get('success') }}
                    <!-- Dismiss (close) button -->
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- ✅ Display error message if set in session --}}
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Card component for listing -->
            <div class="card p-0 m-3">
                
                <!-- Card header section -->
                <div class="card-header bg-dark text-white">
                    <h4 class="h4">Products</h4>
                </div>

                <!-- Card body with product table -->
                <div class="card-body shadow-lg">

                    <table class="table table-striped"> <!-- Bootstrap striped table -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th width="100">Status</th>
                                <th width="120" class="text-center">Action</th> 
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Check if products collection is not empty -->
                            @if ($products -> isNotEmpty())
                                
                                <!-- Loop through each product -->
                                @foreach ( $products as $product )
                                <tr>
                                    <!-- Display product ID -->
                                    <th>{{ $product -> id }}</th>

                                    <!-- Display image thumbnail -->
                                    <td>
                                        <img class="rounded" src="{{ asset('uploads/products/' . $product->image) }}" width="50">
                                    </td>

                                    <!-- Display product name, sku, price -->
                                    <td>{{ $product -> name }}</td>
                                    <td>{{ $product -> sku }}</td>
                                    <td>${{ $product -> price }}</td>   
                                    
                                    <!-- Status badge: green for active, red for inactive -->
                                    <td>
                                        @if (($product->status) == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    
                                    <!-- Action buttons: Edit + Delete -->
                                    <td class="text-center">
                                        
                                        <!-- Edit button -->
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                        <!-- Delete button in form -->
                                        <form action="{{ route('products.destroy', $product->id) }}"
                                              method="post"
                                              class="d-inline-"
                                              onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            
                                            @csrf <!-- CSRF token for security -->
                                            @method('DELETE') <!-- Use DELETE method spoofing -->
                                            
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                          
                                    </td> 
                                </tr>
                                @endforeach

                            <!-- If product list is empty -->
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No products found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div> <!-- end card-body -->
            </div> <!-- end card -->

        </div> <!-- end row -->
    </div> <!-- end container -->

    <!-- Bootstrap JS for modal, alert, dropdowns, etc. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
