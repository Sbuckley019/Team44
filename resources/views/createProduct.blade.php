@include('includes.navigation')
<body>
    <div class="product-form-container">
        <form action="/products" method="post" class="product-form">
            <h2>Add New Product</h2>

            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category ID:</label>
                <input type="number" id="category_id" name="category_id" required>
            </div>

            <div class="form-group">
                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" id="stock_quantity" name="stock_quantity" required>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="text" id="image_url" name="image_url" required>
            </div>

            <button type="submit">Add Product</button>
        </form>
    </div>
    
@include('includes.footer')
</body>