@include('includes.navigation')

<style>

</style>
<body>
    <div class="card mb-3 d-flex flex-row">
        <div class="align-items-center col-md-6">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-5 shop-product-info">
            <section>
                <div class="shop-product-sale">20% OFF</div>
                <h1  class="shop-product-name">{{$product->product_name}}</h1>
                <span class="shop-product-description">{{$product->description}}</span>
                <div class="shop-product-price">£{{$product->price}}</div>
            </section>
            <section class="shop-product-buttons">
                <button id="shop-rating" class="shop-product-button">
                    <i class="fas fa-star"></i>
                    <span class="shop-span">{{$product->rating}}</span>
                </button>
                <button class="shop-product-button">
                    <i class="fas fa-heart"></i>
                </button>
                <button id="shop-copy" class="shop-product-button">
                    <i class="far fa-copy"></i>
                </button>
            </section>
            <button class="shop-cart-button">add to bag</button>
        </div>
    </div>
<hr>
    <div class="container product-description2 text-center">
        <h2>Product Description</h2>
        <p>This is an additional description for the product. You can add more details here.</p>
    </div>
    <hr>
    <div class="text-center"> <!-- Added text-center class -->
        <h2>People Also Brought</h2>
        <div class="carousel-container">
            <div class="carousel-slide">
                @foreach ($mostPurchased as $product)
                @include('includes.productCard')
                @endforeach
            </div>
            <button class="prev-button">Prev</button>
            <button class="next-button">Next</button>
        </div>
    </div>
    <hr>
    <div class="text-center"> <!-- Added text-center class -->
        <h2>Best Sellers In This Category</h2>
        <div class="carousel-container">
            <div class="carousel-slide">
                @foreach ($alsoPurchased as $product)
                @include('includes.productCard')
                @endforeach
            </div>
            <button class="prev-button">Prev</button>
            <button class="next-button">Next</button>
        </div>
    </div>
    <hr id="review-section">
    <div class="container customer-reviews">
        <h2>Customer reviews</h2>
        <div>
            @if(!$reviews->isEmpty())
                @foreach($reviews as $review)
                <div class="review-box">  
                    <div class="review-user">{{$review->user->username}}</div>
                    <div class="review-rating">
                        <div class="stars" style="--rating: {{($review->rating)/5 * 100}}%"></div>
                        <div class="review-heading">{{$review->review_heading}}</div>
                    </div>
                    @if(1==1)<div class="review-verified">Verified Purchase</div>@endif
                    <div class="review-time">Reviewed on {{$review->created_at}}</div>
                    <div class="review-text">{{$review->review_text}}</div>
                    @if($review->helpfulness>0)
                    <div class="review-helpfulness">
                        {{ $review->helpfulness == 1 ? 'One person found this helpful' : $review->helpfulness . ' people found this helpful' }}
                    </div>
                    @endif
                    <button class="review-helpful-button reviewid" type="button" value="{{$review->id}}">Helpful</button>
                </div>
                @endforeach
                <div class="review-rating">
                    <button href="{{ $reviews->previousPageUrl() }}" class="review-helpful-button" type="button" value="{{$review->id}}">< Previous Page</button>
                    <button href="{{ $reviews->previousPageUrl() }}" class="review-helpful-button" type="button" value="{{$review->id}}">Next Page ></button>
                </div>
                
            @else
            There are currently no reviews for this product
            @endif
            
        </div>
    </div>

    @include('includes.footer')
</body>
