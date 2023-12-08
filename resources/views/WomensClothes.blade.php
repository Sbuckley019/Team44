<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Womens Gym Clothes - Gains</title>
<link rel="stylesheet" href="styles.css">
<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }
    .container {
        width: 80%;
        margin: auto;
        flex: 1;
    }
    header {
        background: #333;
        color: white;
        padding: 1em 0;
        text-align: center;
    }
    .product-box {
        background: #f9f9f9;
        border: 1px solid #ddd;
        margin-bottom: 2em;
        padding: 1em;
        text-align: center;
    }
    .product-box img {
        max-width: 100%;
        height: auto;
        margin-bottom: 1em;
    }
    .product h3 {
        margin-top: 0.5em;
    }
    .product p {
        color: #555;
        margin-bottom: 1em;
    }
    .product .price {
        color: #e8491d;
        font-size: 1.2em;
        margin-bottom: 1em;
    }
    .product .buy-now {
        background-color: #e8491d;
        color: white;
        text-decoration: none;
        padding: 0.5em 1em;
        display: inline-block;
    }
    footer {
        background: #333;
        color: white;
        text-align: center;
        padding: 1em 0;
        width: 100%;
    }
</style>
</head>
<body>
    
    @include('Navigation')

    <div class="container">
        <header>
            <h1>Women's Gym Clothes</h1>
        </header>

        <section class="product-list">
            <div class="product-box">
                <h3>Women's Trail 2.0 1/4 Zip - Neon Pink Multi</h3>
                <img src="WC1.jpg">
                <p class="price">£19.99</p>
                <p>This Women's Trail 2.0 1/4 Zip is perfect for outdoor adventures. It's tailored to a standard fit for great comfort and features reflective detailing for increased visibility. Its lightweight and breathable fabric ensures unrestricted movement and optimal airflow.</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>

            <div class="product-box">
                <h3>Scrunch Seamless Crop ½ Zip Sage</h3>
                <img src="WC2.jpg">
                <p class="price">£36.00</p>
                <p>Reach for the Scrunch Seamless Crop ½ Zip for next-level performance and style. Its buttery-soft, ultra-stretchy fabric allows free movement with a midriff crop that keeps you cool and dry. Thumbholes and a ½ zip provide added comfort and a put-together look to complete your gym fit. Ideal for training, running, and everyday wear.</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>

            <div class="product-box">
                <h3>MP Women's Shape Seamless 7/8 Leggings - Pebble Blue</h3>
                <img src="WC3.jpg">
                <p class="price">£12.99</p>
                <p>Designed to support and sculpt, our Shape Seamless Ultra 7/8 Leggings offer a high-waisted supportive fit, ideal to keep you covered and confident throughout all training types.</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>

            <div class="product-box">
                <h3>GS POWER OVERSIZED T-SHIRT</h3>
                <img src="WC4.jpg">
                <p class="price">£27.99</p>
                <p>Power your pursuit of perfection in a range that is truly made for lifting. Hit big numbers with 0 distraction designs, pre- and post- workout cover ups and supportive fits.</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>

            <div class="product-box">
                <h3>Seamless Shorts</h3>
                <img src="WC5.jpg">
                <p class="price">£12.99</p>
                <p>Seamless technology is the future of fitness wear, and our USA PRO 3 inch shorts will give you the confidence and style in the gym, park, yoga studio or just working out at home.</p>
                <a href="#" class="buy-now">Buy Now</a>
            </div>
        </section>
    </div>

    <footer>
        <p>Gains &copy; 2023</p>
    </footer>
</body>
</html>
