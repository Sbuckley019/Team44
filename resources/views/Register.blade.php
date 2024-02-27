<body>
    @include("includes.navigation")
    <div class="register-container">
        <div class="back">
            <div class="register-form-box">
                @if(session('login'))
                <div class="register-msg">{{ session('login') }}</div>
                @endif
                <div class="register-button-box">
                    <div id="register-btn"></div>
                    <button type="button" class="register-toggle-btn" onclick="login()">Log in</button>
                    <button type="button" class="register-toggle-btn" onclick="signup()">Sign up</button>
                </div>

                <form action="{{ route('register.login') }}" method="post" id="login" class="register-input-group">
                    @csrf
                    <div class="register-elements">
                        <label class="register-input-label" for="username">Username</label>
                        <input type="text" class="register-input-field" placeholder="Enter username" name="username" required>
                        <label class="register-input-label" for="password">Password</label>
                        <input type="password" class="register-input-field" placeholder="Enter password" name="password" required>
                        <a class="register-forgot" href="{{route('home')}}">Forgot Password?</a>
                    </div>
                    <button type="submit" class="register-submit-btn">Log in</button>
                </form>

                <form action="{{ route('register.store') }}" method="post" id="signup" class="register-input-group">
                    @csrf
                    <div class="register-elements">
                        <label class="register-input-label" for="username">Username</label>
                        <input type="text" class="register-input-field" placeholder="Enter username" name="username" required>
                        <label class="register-input-label" for="email">Email</label>
                        <input type="email" class="register-input-field" placeholder="Enter email" name="email" required>
                        <label class="register-input-label" for="password">Password</label>
                        <input type="password" class="register-input-field" placeholder="Enter password" name="password" required>
                        <label class="register-input-label" for="password">Password</label>
                        <input type="password" class="register-input-field" placeholder="Confirm password" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="register-submit-btn">Sign up</button>
                </form>
            </div>
        </div>
    </div>
</body>


<script>
    var x = document.getElementById("login");
    var y = document.getElementById("signup");
    var z = document.getElementById("register-btn");

    function signup() {
        x.style.left = "-400px";
        y.style.left = "50px";
        z.style.left = "130px";
    }

    function login() {
        x.style.left = "50px";
        y.style.left = "450px";
        z.style.left = "0";
    }
</script>

</body>