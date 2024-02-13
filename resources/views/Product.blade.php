<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gains - Fitness Products</title>
    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        .category {
            margin-bottom: 20px;
        }
        .category img {
            width: 100%;
            max-width: 300px;
            height: auto;
        }
        .category a {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
@include('Navigation')

    <div class="container">
        <h1>Welcome to Gains</h1>
        <p>Your one-stop shop for fitness and wellness products</p>

        <div class="category">
            <h2>Gym Equipment</h2>
            <img src="path-to-your-gym-equipment-image.jpg" alt="Gym Equipment">
            <a href="Equipment">Explore Gym Equipment</a>
        </div>

        <div class="category">
            <h2>Men's Clothing</h2>
            <img src="path-to-your-mens-clothing-image.jpg" alt="Men's Clothing">
            <a href="link-to-your-mens-clothing-page.html">Shop Men's Clothing</a>
        </div>

        <div class="category">
            <h2>Women's Clothing</h2>
            <img src="path-to-your-womens-clothing-image.jpg" alt="Women's Clothing">
            <a href="link-to-your-womens-clothing-page.html">Shop Women's Clothing</a>
        </div>

        <div class="category">
            <h2>Supplements</h2>
            <img src="path-to-your-supplements-image.jpg" alt="Supplements">
            <a href="link-to-your-supplements-page.html">Browse Supplements</a>
        </div>
    </div>
</body>
</html>
