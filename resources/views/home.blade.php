<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
@include('includes.navigation')
<body>
    <div class="hero-container">
        <a href="plist" class="hero-column" id="hero-img1">
            <div class="overlay-link">Mens</div>
        </a>
        <a href="plist" class="hero-column" id="hero-img2">
            <div class="overlay-link">Womens</div>
        </a>
    </div>
    <div class= "hero-subcategories">
            <a href="plist" class="hero-sub">Shoes</a>
            <a href="plist" class="hero-sub">Accessories</a>
            <a href="plist" class="hero-sub">Supplements</a>
    </div>

@include('includes.footer')
</body>
