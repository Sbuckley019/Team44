<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="change-password-styles.css">
</head>
@include('includes.navigation')
<body>
    <div class="change-password-container">
        <h2 id="change-password-heading">Change Password</h2>
        <form action="/changepass" method="post" id="change-password-form">
            @csrf
            <label for="old-password" class="cp-label">Old Password:</label>
            <input type="password" id="old-password" name="old-password" class="cp-input" required>

            <label for="new-password" class="cp-label">New Password:</label>
            <input type="password" id="new-password" name="password" class="cp-input" required>

            <label for="confirm-password" class="cp-label">Confirm New Password:</label>
            <input type="password" id="confirm-password" name="password_confirmation" class="cp-input" required>

            <button type="submit" id="change-password-btn" class="cp-btn">Change Password</button>
        </form>
    </div>
</body>
</html>