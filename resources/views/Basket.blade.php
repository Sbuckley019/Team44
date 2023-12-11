<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>

    @include('includes.navigation')
    <script>
        function updateTotal() {
            var subtotals = document.querySelectorAll('.subtotal');
            var total = 0;

            subtotals.forEach(function(subtotal) {
                total += parseFloat(subtotal.textContent.replace('£', ''));
            });


            document.getElementById('total-amount').textContent = '£' + total.toFixed(2);
        }
    </script>
</head>

<body>
    <div class="small-container basket-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            @if(isset($basket))
            @forEach($basket->items as $item)
            <tr>
                <td>
                    <div class="basket-info">
                        <img src="{{$item->product->image_url}}" alt="Product Image">
                        <div class="product-details">
                            <p>{{$item->product->product_name}}</p>
                            <small>Price £{{$item->product->price}}</small>
                            <div class="remove-link">
                                <a href="{{ route('home') }}">Remove</a>
                            </div>
                        </div>
                    </div>

    </td>
    <td><input type="Label" class="quantity" min="1" value="{{$item->quantity}}" onchange="updateTotal()"></td>
    <td class="subtotal">£{{$item->product->price}}</td>
    @endforeach
    @endif
</tr>
            <tr>
                <td colspan="2"></td>
                <td>
                    <div class="total-price">
                        <table>
                            <tr>
                                <td>Total:</td>
                                <td id="total-amount">£0.00</td>
                            </tr>
                        </table>
                    </div>
                    <button class="checkout-button">Checkout</button>
                </td>
            </tr>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', updateTotal);
    </script>
    @include('includes.footer')
</body>

</html>