@include('includes.navigation')

<body>
    <div class="container">
        <h1>{{ $product->product_name }}</h1>
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
        <p>{{ $product->description }}</p>
        <p>Price: ${{ $product->price }}</p>
        <div class="action-buttons">
            <div class="stars" style="--rating: {{($product->rating)/5 * 100}}%"></div>
            <form action="{{ route('basket.add', ['productId' => $product->id]) }}" method="post">
                @csrf
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
            </form>
        </div>
    </div>
    @include('includes.footer')
</body>