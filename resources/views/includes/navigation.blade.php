<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}" defer></script>
    <title>Gains</title>
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <img src="images/logo.png" height="50"> <!-- Replace with your logo -->
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('aboutUs') }}">About Us</a>
            <a href="{{ route('contact') }}">Contact Us</a>
            <a href="products.html">Products</a>
            <a href="orders.html">Previous Orders</a>
        </div>
        <div class="navbar-right">
            <a href="{{ route('signup') }}">Sign Up</a>
            <a href="{{ route('login') }}">Log In</a>
            <a href="basket.html">Current Basket</a>
        </div>
    </div>
</body>
</html>
