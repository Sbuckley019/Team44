

@include('includes.navigation')
<body>
    <div class="title-container">
        Mens Clothing
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search...">
            <button class="search-button">Search</button>
        </div>
    </div>
    <div class="project-page-container">
        <div class="filter-container">Filters</div>
        <div class="products-container">
    @foreach ($products as $product)
    <div class="product-card">
        <img class="product-image" src="{{$product->image_url}}" alt="Product Image">
        <div class="product-details">
            <div class="product-name">{{$product->product_name}}</div>
            <div class="product-description">{{$product->description}}</div>
            <div class="product-price">£{{$product->price}}</div>
            <button class="favorite-btn"><i class="fas fa-heart"></i></button>
            <div class="action-buttons">
                <i class="fas fa-star"> 4.3</i>
                <form action="{{ route('basket.add', ['productId' => $product->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="add-to-cart-btn">Add to Cart</a>
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>
</div>
@include('includes.footer');
</body>