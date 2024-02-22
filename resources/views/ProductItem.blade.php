@include('includes.navigation')

<style>
    .product-container {
    display: flex;
    justify-content: space-between;
}

.product-image {
    max-width: 100%; /* Adjust as needed */
    margin-right: 20px; /* Adjust spacing between image and content */
}

.product-details {
    width: 50%; /* Adjust as needed */
}

.product-title {
    font-size: 24px; /* Adjust as needed */
    font-weight: bold;
    margin-bottom: 10px;
}

.product-price {
    font-size: 20px; /* Adjust as needed */
    color: #e8491d; /* Adjust color as needed */
    margin-bottom: 10px;
}

.product-description {
    font-size: 16px; /* Adjust as needed */
    margin-bottom: 20px;
}

.action-buttons {
    display: flex;
    flex-direction: column;
}

.add-to-basket-btn,
.checkout-btn {
    width: 100%; /* Adjust as needed */
    padding: 10px;
    margin-bottom: 10px; /* Adjust spacing between buttons */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
}

.add-to-basket-btn {
    background-color: #3498db; /* Adjust colors as needed */
    color: white;
}

.checkout-btn {
    background-color: #27ae60; /* Adjust colors as needed */
    color: white;
}

hr {
    width:75%;
    margin: auto;
    padding: 15px;
}
    </style>
<html>
<body>
    <div class="card mb-3 m-5">
        <div class="row no-gutters align-items-center">
            <div class="col-md-3 d-flex justify-content-center">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
            <div class="col-md-9">
                <h1>{{ $product->product_name }}</h1>
                <p>{{ $product->description }}</p>
                <p>Price: ${{ $product->price }}</p>
                <div class="action-buttons">
                    <form action="{{ route('basket.add', ['productId' => $product->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
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
    <class="container customer-reviews">
        <h2>Customer reviews</h2>
    </div>

    @include('includes.footer')
</body>
</html>