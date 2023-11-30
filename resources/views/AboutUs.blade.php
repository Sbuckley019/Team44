<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Us - Gains</title>
<style>
    /* CSS */
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: auto;
        overflow: hidden;
    }
    header {
        background: #333;
        color: #fff;
        padding-top: 30px;
        min-height: 70px;
        border-bottom: #bbb 1px solid;
    }
    header a {
        color: #fff;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 16px;
    }
    header ul {
        padding: 0;
        list-style: none;
    }
    header ul li {
        display: inline;
        padding: 0 20px 0 20px;
    }
    header #branding {
        float: left;
    }
    header #branding h1 {
        margin: 0;
    }
    header nav {
        float: right;
        margin-top: 10px;
    }
    header .highlight, header .current a {
        color: #e8491d;
        font-weight: bold;
    }
    header a:hover {
        color: #ffffff;
        font-weight: bold;
    }
    .about-section {
        padding: 50px 0;
        background: #f4f4f4;
    }
    .mission {
        padding: 50px 0;
    }
    .offer {
        padding: 50px 0;
        background: #e2e2e2;
    }
</style>
</head>
/* Website */
<body>
@include('Navigation')

    <section class="about-section">
        <div class="container">
            <h1>About Gains</h1>
            <p>
                Gains is a leading e-commerce platform dedicated to fitness enthusiasts, offering premium gym equipment, clothing, and accessories. Our mission is to provide a smooth shopping experience supported by an extensive inventory control system for effective order fulfillment.
            </p>
        </div>
    </section>

    <section class="mission">
        <div class="container">
            <h1>Our Mission</h1>
            <p>
                Our mission is to empower individuals in their fitness journey by providing top-quality products that cater to all ages and fitness levels. Whether you're just starting out or a seasoned athlete, we are committed to supporting your training and workout needs.
            </p>
        </div>
    </section>

    <section class="offer">
        <div class="container">
            <h1>What We Offer</h1>
            <p>
                We offer a wide selection of fitness products, from state-of-the-art gym equipment to stylish and functional workout apparel. Our user-friendly website and robust inventory system ensure you have access to the latest and most effective fitness tools on the market.
            </p>
        </div>
    </section>

    <footer>
        <p>Gains &copy; 2023</p>
    </footer>
</body>
</html>