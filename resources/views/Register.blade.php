<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}" defer></script>
</head>
<body>
    @include("Navigation")
<div class="back">
    <div class="form-box">
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn" onclick="login()">Log in</button>
            <button type="button" class="toggle-btn" onclick="signup()">Sign up</button>
        </div>

        <form id="login" class="input-group">
            <input type="text" class="input-field" placeholder="Username" required>
            <input type="text" class="input-field" placeholder="Password" required>
            <input type="checkbox" class="check-box"><span>Remember me</span>
            <button type="submit" class="submit-btn">Log in</button>
        </form>
        <form id="signup" class="input-group">
            <input type="text" class="input-field" placeholder="Username" required>
            <input type="text" class="input-field" placeholder="Password" required>
            <input type="email" class="input-field" placeholder="Email" required>
            <input type="checkbox" class="check-box"><span>I agree to the terms and conditions</span>
            <button type="submit" class="submit-btn">Sign up</button>
        </form>
    </div>
        </div>

        <script>
        var x = document.getElementById("login");
        var y = document.getElementById("signup");
        var z = document.getElementById("btn");

        function signup() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
        }
        </script>
</body>
</html>