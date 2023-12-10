<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            color: white;
            padding: 10px;
            height: 54px;
        }
        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar-left {
            display: flex;
            align-items: center;
        }
        .navbar-left img {
            margin-right: 20px;
        }
        .navbar-right {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <a href="{{ route('home') }}"><img src="images/logo.png" height="80"></a>
            <a href="AboutUs">About Us</a>
            <a href="Contact">Contact Us</a>
            <a href="products.html">Products</a>
            <a href="orders.html">Previous Orders</a>
        </div>
        <div class="navbar-right">
            <a href="{{ route('register') }}"> <img src="images/profile.png" alt="Register" height="35"></a>
            <a href="basket.html"> <img src="images/Basket.png" alt="basket" height="35"></a>
        </div>
    </div>
</body>
</html>
