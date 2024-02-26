@include('includes.navigation')
<div class="title-container">
    Favourites
</div>

@if(isset($favourites) && count($favourites)>0)
<div class="products-container">
    @foreach ($favourites as $product)
    <a href="{{route('home')}}" class="product-card-link">
        <div class="product-card">
            <img class="product-image" src="{{$product->image_url}}" alt="Product Image">
            <div class="product-details">
                <div class="product-name">{{$product->product_name}}</div>
                <div class="product-description">{{$product->description}}</div>
                <div class="product-price">£{{$product->price}}</div>
                @if(auth()->check())
                <form action="{{route('favourite.add', ['productId' => $product->id]) }}" method="POST">
                    @csrf
                    <button class="fav-button">
                        <i class="fas fa-heart filled"></i>
                    </button>
                </form>
                @endif
                <div class="action-buttons">
                    <i class="fas fa-star"> 4.3</i>
                    <form action="{{ route('basket.add', ['productId' => $product->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>
@else
<div>You do not have any favourites at the moment</div>
@endif
@include('includes.footer')

