@include('Navigation');
<h2>Create Product</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category ID:</label>
                <input type="number" name="category_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" name="stock_quantity" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="text" name="image_url" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>