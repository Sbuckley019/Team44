<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{asset('js/app.js')}}" defer></script>
    <title>Gains</title>
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <img src="{{ asset('images/Logo.png') }}" height="50"> <!-- Replace with your logo -->
            <a href="{{ route('home') }}">Home</a>
            <div class="dropdown">
                <a href="{{ route('products.index')}}" class='dropdown-item'>Products</a> 
                <div class="dropdown-content">
                    <a href="{{ route('products.index',['id'=>1])}}">Mens Clothing</a>
                    <a href="{{ route('products.index',['id'=>2])}}">Womens Clothing</a>
                    <a href="{{ route('products.index',['id'=>3])}}">Shoes</a>
                    <a href="{{ route('products.index',['id'=>4])}}">Accessories</a>
                    <a href="{{ route('products.index',['id'=>5])}}">Supplements</a>
                </div>
            </div>
            <a href="{{ route('aboutUs') }}">About Us</a>
            <a href="{{ route('contact') }}">Contact Us</a>
        </div>
        <div class="navbar-right">
        <div class="admin-button">
        <a href="{{ route('admin.login') }}">
        <img src="{{ asset('images/admin.png') }}" height="65" alt="Admin Login"> <!-- Image acts as a button -->
        </a>
        </div>



            @if (auth()->check())
            <div class="dropdown"> 
                <a class="dropdown-item name"> Hello, {{ auth()->user()->username }} </a>
                <div class="dropdown-content">
                    <!--<a href="{{route('orders')}}">My Orders</a>!-->
                    <a href="{{ route('passchange') }}">Change Password</a>
                    <!--<a href="GymAccessories">Update Account Details</a>-->
                    <a href="{{route('favourite.index')}}">Favourites</a>
                    <a href="{{route('logout')}}">Log out</a>
                </div>
            </div>
            @else
            <a href="{{ route('register') }}"> <img src="{{ asset('images/profile.png') }}" alt="signup" height="35"></a>
            @endif
            <a href="{{route('basket.index')}}"> <img src="{{ asset('images/Basket.png') }}" alt="basket" height="35"></a>
        </div>
    </div>
</body>
</html>
