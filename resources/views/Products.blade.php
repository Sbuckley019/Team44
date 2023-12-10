

@include('includes.navigation')
<body>
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
                <button class="add-to-cart-btn">Add to Cart</button>
            </div>
        </div>
    </div>
@endforeach

@include('includes.footer');
</body>