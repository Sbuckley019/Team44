@include('includes.navigation')

<body>
    <div class="product-form-container">
        <form action="/products" method="post" class="product-form">
            @csrf
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
                <input type="number" id="price" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" id="stock_quantity" name="stock_quantity" required>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="text" id="image_url" name="image_url" required>
            </div>
            <button type="button" id="viewCardBtn" class="product-button">View Product Card</button>
            <button type="submit" class="product-button">Add Product</button>
        </form>
        <div id="productCardModal">
            <div id="productCardContainer">
                <!-- This is where you'll dynamically show the product card -->
                <div id="productCardPreview"></div>
                <button type="button" onclick="closeProductCard()">Close</button>
            </div>
        </div>
    </div>
    
@include('includes.footer')
</body>