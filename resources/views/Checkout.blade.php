@include('includes.navigation')

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Checkout</div>

                    <div class="card-body">
                        @auth
                        <!-- show a summary of the items in the basket -->
                        <h5>Order Summary</h5>
                        <ul>
                            @foreach(auth()->user()->basketItems as $item)
                            <li>{{ $item->product_name }} - Quantity: {{ $item->quantity }} - Price: ${{ $item->product->price * $item->quantity }}</li>
                            @endforeach
                        </ul>

                        <!-- show the total price -->
                        <p>Total Price: ${{ auth()->user->basketTotalPrice }}</p>

                        <!-- checkout form -->
                        <form action="{{ route('checkout.process') }}" method="post">
                            @csrf
                            <!-- user details -->
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" required>
                            </div>

                            <!-- card details -->
                            <div class="form-group">
                                <label for="card_number">Card Number:</label>
                                <input type="text" name="card_number" id="card_number" required>
                            </div>

                            <div class="form-group">
                                <label for="expiry_date">Expiry Date:</label>
                                <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YY" required>
                            </div>

                            <div class="form-group">
                                <label for="cvv">CVV:</label>
                                <input type="text" name="cvv" id="cvv" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                        </form>
                        @else
                        <p>You must be logged in to proceed to checkout. <a href="{{ route('register') }}">Login</a></p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>