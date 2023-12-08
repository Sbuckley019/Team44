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
        .dropdown {   
            position: relative;       
            display: inline-block;   
        }  
        .dropdown-content {       
            display:none;
            flex-direction: column;
            position: absolute;       
            background-color: #f9f9f9;       
            min-width: 160px;       
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);      
            z-index: 1; 
        }     
        .dropdown:hover .dropdown-content {   
            display:flex;
            flex-direction: column;
        }    
        .dropdown-item {      
            padding: 12px 16px;       
            text-decoration: none;       
            display: block;       
            color: black; /* Change text color to black */
        }     
        .dropdown-item:hover {       
            background-color: #ddd;     
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <img src="images/logo.png" height="50" alt="Logo"> <!-- Replace with your logo -->
            <a href="{{ route('home') }}">Home</a>
            <a href="AboutUs">About Us</a>
            <a href="Contact">Contact Us</a>
            <div class="dropdown">
                <a href="Products" class='dropdown-item'>Products</a> 
                <div class="dropdown-content">
                    <a href="Equipment">Gym Equipment</a>
                    <a href="WomensClothes">Womens Clothes</a>
                    <a href="GymAccessories">Gym Accessories</a>
                </div>
            </div>
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
