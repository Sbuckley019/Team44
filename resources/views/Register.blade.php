<body>
    @include("includes.navigation")
    <div class="register-container">
<div class="back">
    <div class="register-form-box">
        <div class="register-button-box">
            <div id="register-btn"></div>
            <button type="button" class="register-toggle-btn" onclick="login()">Log in</button>
            <button type="button" class="register-toggle-btn" onclick="signup()">Sign up</button>
        </div>

        <form id="login" class="register-input-group">
            <input type="text" class="register-input-field" placeholder="Username" required>
            <input type="text" class="register-input-field" placeholder="Password" required>
            <input type="checkbox" class="register-check-box"><span>Remember me</span>
            <button type="submit" class="register-submit-btn">Log in</button>
        </form>
        <form id="signup" class="register-input-group">
            <input type="text" class="register-input-field" placeholder="Username" required>
            <input type="email" class="register-input-field" placeholder="Email" required>
            <input type="text" class="register-input-field" placeholder="Password" required>
            <input type="text" class="register-input-field" placeholder="Confirm Password" required>
            <input type="checkbox" class="register-check-box"><span>I agree to the terms and conditions</span>
            <button type="submit" class="register-submit-btn">Sign up</button>
        </form>
    </div>
        </div>
</div>

        <script>
        var x = document.getElementById("login");
        var y = document.getElementById("signup");
        var z = document.getElementById("register-btn");

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
