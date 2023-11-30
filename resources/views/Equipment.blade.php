<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gym Equipment - Gains</title>
<link rel="stylesheet" href="styles.css">
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .container {
        width: 80%;
        margin: auto;
    }
    header {
        background: #333;
        color: white;
        padding: 1em 0;
        text-align: center;
    }
    nav ul {
        list-style: none;
        padding: 0;
    }
    nav ul li {
        display: inline;
        margin-right: 10px;
    }
    nav a {
        text-decoration: none;
        color: white;
    }
    .product-list {
        margin: 2em 0;
    }
    .product {
        border: 1px solid #ddd;
        margin-bottom: 1em;
        padding: 1em;
        background: #f9f9f9;
    }
    .product img {
        max-width: 100%;
        height: auto;
    }
    .product h3 {
        margin-top: 0.5em;
    }
    .product p {
        color: #555;
    }
    .product .price {
        color: #e8491d;
        font-size: 1.2em;
    }
    .product .buy-now {
        background-color: #e8491d;
        color: white;
        text-decoration: none;
        padding: 0.5em 1em;
        display: inline-block;
        margin-top: 1em;
    }
</style>
</head>
<body>
    
    @include('Navigation')

    <div class="container">
        <!-- Featured Equipment Section -->
        <section class="featured-equipment">
            <h2>Featured Equipment</h2>
           
        </section>

        <!-- Categories Section -->
        <section class="categories">
            <h2>Categories</h2>
            <nav>
                <ul>
                    <li><a href="#weights">Weights</a></li>
                    <li><a href="#cardio">Cardio Machines</a></li>
                    <li><a href="#accessories">Accessories</a></li>
                </ul>
            </nav>
        </section>

        <!-- Product List Section -->
        <section class="product-list">
            <h2>Our Products</h2>
            <!-- Product Item -->
            <div class="product" id="weights">
                <img src="weight-set.jpg" alt="Weight Set">
                <h3>Deluxe Weight Set</h3>
                <p>Start your home gym with our comprehensive weight set, suitable for all levels of fitness enthusiasts.</p>
                <p class="price">$299</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>
           
        </section>
    </div>

    <footer>
        <p>Gains &copy; 2023</p>
    </footer>
</body>
</html>