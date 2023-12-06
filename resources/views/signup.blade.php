<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Sign Up</title>
</head>
<body>
<section>
        <header>
    <nav class="navbar">
        <div class="navbar__container">
        <img src="images/Logo.png" alt="navbar__logo"></div>
        <div class="navbar__toggle" id="mobile-menu">
            <span class="bar"></span> <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <ul class="navbar__menu">
            <li class="navbar__item">
                <a href="{{ route('home') }}" class="navbar__links">Home</a>
            </li>
            <li class="navbar__item">
                <a href="/" class="navbar__links">Product</a>
            </li>
            <li class="navbar__item">
                <a href="About.html" class="navbar__links">About Us</a>
            </li>
            <li class="navbar__item">
                <a href="{{ route('signup') }}" class="navbar__links">Sign Up</a>
            </li>
            <li class="navbar__item">
                <a href="{{ route('login') }}" class="navbar__links">Log in</a>
            </li>
            <li class="navbar__item">
                <a href="Basket.html" class="navbar__links">Basket</a>
            </li>
            </ul>
        </div>
    </nav>
</header>
</section>

    <div class="signup-container">
        <form id="signup-form">
            <h1>Create an Account</h1>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="password">Confirm Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="button" onclick="signup()">Sign Up</button>
        </form>
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>

    <div class="footer">
        <br>
        <p>Team 44 | socials | email </p>
        <br>
</div>
</body>
</html>