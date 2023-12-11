

@include('includes.navigation')
<body>
    <div class="hero-content">
        <img src="images/hero.jpg" alt="hero__img">
            <div class="text-overlay">
            <div class="hero-text">Mens Clothing</div>
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
                <a href="" class="add-to-cart-btn">Add to Cart</a>
            </div>
        </div>
    </div>
@endforeach
</div>
</div>
@include('includes.footer');
</body>