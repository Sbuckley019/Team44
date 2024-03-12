@include('includes.navigation')

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Checkout</div>

                    <div class="card-body">
                        <!-- show a summary of the items in the basket -->
                        <h5>Order Summary</h5>
                        <div class="small-container basket-page">
                            <table>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                                @if(isset($basket))
                                @foreach($basket->items as $item)
                                <tr>
                                    <td>
                                        <div class="basket-info">
                                            <img src="{{ $item->product->image_url }}" alt="Product Image">
                                            <div class="product-details">
                                                <p>{{ $item->product->product_name }}</p>
                                                <form action="{{ route('basket.remove',['productId'=> $item->product->id]) }}" method="post" class="remove-link">
                                                    @csrf
                                                    <button type="submit">Remove</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->quantity }}
                                    <td class="subtotal">£{{ ($item->product->price) * $item->quantity }}</td>
                                </tr>
                                @endforeach
                                @endif
                                <tr>
                                    <td colspan="2"></td>
                                    <td>
                                        <div class="total-price">
                                            <table>
                                                <tr>
                                                    @php
                                                    $totalPrice = 0;
                                                    @endphp

                                                    @foreach ($basket->items as $item)
                                                    @php
                                                    $totalPrice += $item->quantity * $item->product->price;
                                                    @endphp
                                                    @endforeach

                                                    <td>Total:</td>
                                                    <td id="total-amount">£{{ number_format($totalPrice, 2) }}</td>
                                                </tr>
                                            </table>
                                        </div>

                                    </td>
                                </tr>
                            </table>
                        </div>

                        <h4>Contact</h4>

                        <!-- checkout form -->
                        <form action="{{ route('checkout.process') }}" method="post" class="row g-3">
                            @csrf
                            <!-- user details -->
                            <div class="form-group col-md-4">
                                <label for="first_name" class="form-label">First Name:</label>
                                @if(auth()->check())
                                <input class="form-control" type="text" name="first_name" id="first_name" value="{{ auth()->user()->first_name }}" required>
                                @else
                                <input class="form-control" type="text" name="first_name" id="first_name" required>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="last_name" class="form-label">Last Name:</label>
                                @if(auth()->check())
                                <input class="form-control" type="text" name="name" id="name" value="{{ auth()->user()->last_name }}" required>
                                @else
                                <input class="form-control" type="text" name="name" id="name" required>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="phone_number" class="form-label">Phone Number:</label>
                                @if(auth()->check())
                                <input class="form-control" type="text" name="phone_number" id="phone_number" value="{{ auth()->user()->phone_number }}" required>
                                @else
                                <input class="form-control" type="text" name="phone_number" id="phone_number" required>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <label for="email" class="form-label">Email:</label>
                                @if(auth()->check())
                                <input class="form-control" type="email" name="email" id="email" value="{{ auth()->user()->email }}" required>
                                @else
                                <input class="form-control" type="email" name="email" id="email" required>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label">Address:</label>
                                @if(auth()->check())
                                <input class="form-control" type="text" name="address" id="address" value="{{ auth()->user()->address }}" required>
                                @else
                                <input class="form-control" type="text" name="address" id="address" required>
                                @endif
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="use_shipping_as_billing" id="use_shipping_as_billing" checked>
                                <label class="form-check-label" for="use_shipping_as_billing">
                                    Use Shipping Address as Billing Address
                                </label>
                            </div>

                            <!-- Billing Address Input (Initially Hidden) -->
                            <div id="billing_address_input" style="display: none;">
                                <div class="form-group">
                                    <label for="billing_address">Billing Address:</label>
                                    <input type="text" name="billing_address" id="billing_address">
                                </div>
                            </div>

                            @if (auth()->check())
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="save_info" id="save_info">
                                <label class="form-check-label" for="save_info">Save my information for future orders.</label>
                            </div>
                            @endif

                            <h4>Shipping method</h4>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="free_delivery" id="free_delivery" value="0.00" checked>
                                <label class="form-check-label" for="free_delivery">
                                    Free delivery (2-5 working days) £0.00
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="next_day_delivery" id="next_day_delivery" value="6.99">
                                <label class="form-check-label" for="next_day_delivery">
                                    Next day delivery £6.99
                                </label>
                            </div>

                            <!-- card details -->
                            <h4>Payment</h4>
                            <p>All transactions are secured and encrypted. No credit card details are strored.</p>

                            <div class="form-group">
                                <label for="card_number" class="form-label">Card Number:</label>
                                <input class="form-control" type="text" name="card_number" id="card_number" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="expiry_date" class="form-label">Expiry Date:</label>
                                <input class="form-control" type="text" name="expiry_date" id="expiry_date" placeholder="MM/YY" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="cvv" class="form-label">CVV:</label>
                                <input type="text" name="cvv" id="cvv" required>
                            </div>

                            <!-- Total Price Section -->
                            <h4>Total Price</h4>
                            <div id="total_price">£0.00</div>

                            <button type="submit" class="btn btn-primary">Complete Order</button>
                        </form>
                        <script>
                            document.getElementById('use_shipping_as_billing').addEventListener('change', function() {
                                const billingAddressInput = document.getElementById('billing_address_input');

                                billingAddressInput.style.display = this.checked ? 'none' : 'block';
                            });
                        </script>
                        <script>
                            // Add an event listener to the radio buttons
                            const radioButtons = document.querySelectorAll('input[name="free_delivery"], input[name="next_day_delivery"]');
                            radioButtons.forEach(function(radioButton) {
                                radioButton.addEventListener('change', updateTotalPrice);
                            });

                            // Function to update the total price based on the selected shipping method
                            function updateTotalPrice() {
                                // Get the selected shipping method's value
                                const selectedShippingMethod = document.querySelector('input[name="free_delivery"]:checked, input[name="next_day_delivery"]:checked');
                                const shippingCost = parseFloat(selectedShippingMethod.value);

                                // Update the total price element
                                const totalElement = document.getElementById('total_price');
                                const currentTotal = parseFloat(totalElement.innerText.replace('£', ''));
                                const newTotal = currentTotal + shippingCost;

                                totalElement.innerText = '£' + newTotal.toFixed(2);
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
</body>