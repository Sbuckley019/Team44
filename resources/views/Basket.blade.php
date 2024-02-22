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
    @if( $basket != null && count($basket->items) > 0)
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
                        <img src="{{$item->product->image_url}}" alt="Product Image">
                        <div class="product-details">
                            <p>{{$item->product->product_name}}</p>
                            <small>Price £{{$item->product->price}}</small>
                            <form action="{{ route('basket.remove',['productId'=> $item->product->id])}}" method="post" class="remove-link">
                                @csrf
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                    </div>
    </div>

    </td>
    <!--<td><input type="Label" class="quantity" min="1" value="{{$item->quantity}}" onchange="updateTotal()"></td>-->
    <td>
        <form action="{{ route('basket.editQuantity',['productId'=> $item->product->id]) }}" method="POST">
            @csrf
            <button class="minus" aria-label="Decrease by one" name="action" value="0" type="submit">
                <svg width="16" height="2" viewBox="0 0 16 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line y1="1" x2="16" y2="1" stroke="#0064FE" stroke-width="2" class="icon" />
                </svg>
            </button>
            <div class="number dim">{{$item->quantity}}</div>
            <button class="plus" aria-label="Increase by one" name="action" value="1" type="submit">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon">
                    <line x1="8" y1="4.37114e-08" x2="8" y2="16" stroke="#0064FE" stroke-width="2" />
                    <line y1="8" x2="16" y2="8" stroke="#0064FE" stroke-width="2" />
                </svg>
            </button>
        </form>
    </td>
    <td class="subtotal">£{{($item->product->price)*$item->quantity}}</td>
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
            <form action="{{route('order.checkout')}}" method="POST">
                @csrf
                <button type="submit" class="checkout-button">Checkout</button>
            </form>
        </td>
    </tr>
    </table>
    </div>
    @endif

    @else
    <h2> Your basket is empty.</h2>
    <p> There are no products in your basket.</p>
    <a href="{{ route('products.refresh')}}"> Shop All Products </a>
    <script>
        document.addEventListener('DOMContentLoaded', updateTotal);
    </script>
    @include('includes.footer')
</body>

</html>