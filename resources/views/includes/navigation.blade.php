<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{asset('js/app.js')}}" defer></script>
    <title>Gains</title>
</head>

<body>
    <div class="navbar">
        <div class="navbar-left">
<<<<<<< HEAD
        <a href="{{ route('home') }}"><img src="{{ asset('images/Logo.png') }}" height="50"></a>

            
      
        
=======
            <img src="{{ asset('images/Logo.png') }}" height="50"> <!-- Replace with your logo -->
            <a href="{{ route('home') }}">Home</a>
            <a href="{{route('PastOrder')}}">PastOrders</a>
>>>>>>> ce8e227b34dd41b1641c6e667919b4931d24f80b
            <div class="dropdown">
                <a href="{{ route('products.refresh')}}" class='dropdown-item'>Products</a> 
                <div class="dropdown-content">
<<<<<<< HEAD
                    <a href="{{ route('products.index',['id'=>1])}}">Mens Clothing</a>
                    <a href="{{ route('products.index',['id'=>2])}}">Womens Clothing</a>
                    <a href="{{ route('products.index',['id'=>3])}}">Shoes</a>
                    <a href="{{ route('products.index',['id'=>4])}}">Accessories</a>
                    <a href="{{ route('products.index',['id'=>5])}}">Supplements</a>
                    <a href="{{ route('products.index',['id'=>6])}}">Equipment</a>
=======
                    <a href="{{ route('products.refresh',['id'=>1])}}">Mens Clothing</a>
                    <a href="{{ route('products.refresh',['id'=>2])}}">Womens Clothing</a>
                    <a href="{{ route('products.refresh',['id'=>3])}}">Shoes</a>
                    <a href="{{ route('products.refresh',['id'=>4])}}">Accessories</a>
                    <a href="{{ route('products.refresh',['id'=>5])}}">Supplements</a>
>>>>>>> a5c0b813922dd225035fbf3cc31dcc848228966e
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>