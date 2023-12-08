<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Log in</title>
</head>
<body>
    
@include("Navigation")

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