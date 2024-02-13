<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <style>
    /* Add custom CSS here to style your form and its elements */
    body {
      font-family: 'Source Sans Pro', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-box {
      width: 300px;
    }
    .form-control {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }
    .btn-block {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
    }
  </style>
</head>
<body>
<div class="login-box">
  <h1>Admin Login</h1>
  <p>Sign in to start your session</p>

    <form action="{{ route('admin.login') }}" method="post">
    @csrf <!-- Include the CSRF token -->
    <input type="email" class="form-control" placeholder="Username" name="username" required>
    <input type="password" class="form-control" placeholder="Password" name="password" required>
    <input type="checkbox" id="remember" name="remember">
    <label for="remember">Remember Me</label>
    <button type="submit" class="btn-block">Sign In</button>
    </form>

  

  <a href="forgot-password.html">I forgot my password</a>
  <a href="register.html">Register a new membership</a>
</div>
</body>
</html>