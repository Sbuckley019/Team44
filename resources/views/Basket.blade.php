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

            subtotals.forEach(function (subtotal) {
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
            <tr>
    <td>
        <div class="basket-info">
            <img src="images/logo.png" alt="Product Image">
            <div class="product-details">
                <p>Red Printed Tshirt</p>
                <small>Price £50.00</small>
                <div class="remove-link">
            <a href="{{ route('home') }}">Remove</a>
        </div>
            </div>
        </div>
    </td>
    <td><input type="number" class="quantity" value="1" min="1" onchange="updateTotal()"></td>
    <td class="subtotal">£50.00</td>
    <tr>
    <td>
        <div class="basket-info">
            <img src="images/logo.png" alt="Product Image">
            <div class="product-details">
                <p>Red Printed Tshirt</p>
                <small>Price £50.00</small>
                <div class="remove-link">
            <a href="">Remove</a>
        </div>
            </div>
        </div>

    </td>
    <td><input type="number" class="quantity" value="1" min="1" onchange="updateTotal()"></td>
    <td class="subtotal">£50.00</td>
</tr>
<tr>
    <td>
        <div class="basket-info">
            <img src="images/logo.png" alt="Product Image">
            <div class="product-details">
                <p>Red Printed Tshirt</p>
                <small>Price £50.00</small>
                <div class="remove-link">
            <a href="">Remove</a>
        </div>
            </div>
        </div>

    </td>
    <td><input type="number" class="quantity" value="1" min="1" onchange="updateTotal()"></td>
    <td class="subtotal">£50.00</td>
</tr>
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
