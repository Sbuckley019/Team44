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
            <img src="{{ asset('images/Logo.png') }}" height="50"> <!-- Replace with your logo -->
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('aboutUs') }}">About Us</a>
            <a href="{{ route('contact') }}">Contact Us</a>
            <div class="dropdown">
                <a href="{{ route('products.create')}}" class='dropdown-item'>Products</a> 
                <div class="dropdown-content">
                    <a href="Equipment">Gym Equipment</a>
                    <a href="WomensClothes">Womens Clothes</a>
                    <a href="GymAccessories">Gym Accessories</a>
                </div>
            </div>
            <a href="orders.html">Previous Orders</a>
        </div>
        <div class="navbar-right">
            <a href="{{ route('register') }}"> <img src="{{ asset('images/profile.png') }}" alt="signup" height="35"></a>
            <a href="basket.html"> <img src="{{ asset('images/Basket.png') }}" alt="basket" height="35"></a>
        </div>
    </div>
</body>
</html>
