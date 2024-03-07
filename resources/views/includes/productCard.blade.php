<a href="{{route('products.show', $product)}}" class="product-card-link">
            <div class="product-card">
                <img class="product-image" src="{{$product->image_url}}" alt="Product Image">
                <div class="product-details">
                    <div class="product-name">{{$product->product_name}}</div>
                    <div class="product-description">{{$product->description}}</div>
                    <div class="product-price">£{{$product->price}}</div>
                    <div class="action-buttons">
                        <div class="stars" style="--rating: {{($product->rating)/5 * 100}}%"></div>
                        <form id="addToBasketForm" action="{{ route('basket.add', ['productId' => $product->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="add-to-cart-btn" onclick="addToBasket()">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </a>

