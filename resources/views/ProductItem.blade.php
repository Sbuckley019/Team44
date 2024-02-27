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
                <button class="shop-product-button">
                    <i class="fas fa-star"></i>
                    <span class="shop-span">{{$product->rating}}</span>
                </button>
                <button class="shop-product-button">
                    <i class="fas fa-heart"></i>
                </button>
                <button class="shop-product-button">
                    <i class="far fa-copy"></i>
                </button>
            </section>
            <button class="shop-cart-button">add to bag</button>
        </div>
    </div>
<hr>
    <div class="container product-description2 text-center">
        <h2>Additional Product Description</h2>
        <p>This is an additional description for the product. You can add more details here.</p>
    </div>
    <hr>
    <div class="container text-center"> <!-- Added text-center class -->
    <h2>You Also Might Like</h2>
    </div>
    <hr>
    <div class="container customer-reviews">
        <h2>Enter Your review</h2>
        <form>
        <div class="form-group">
                    <label for="Feedback">Message:</label>
                    <textarea class="form-control" id="Feedback" name="feedback" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <fieldset class="rating">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5"></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"></label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1"></label>
                    </fieldset>
                </div>
                <button type="submit" class="btn-submit">Submit</button>
            </form>
    </div>
    <div>
    <div class="container customer-reviews">
        <h2>Customer reviews</h2>
    </div>

    @include('includes.footer')
</body>
