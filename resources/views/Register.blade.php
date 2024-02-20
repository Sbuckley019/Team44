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

                <div class="fixed-bottom mx-3 mb-3">
                    @if(Session()->has('success'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert" style="max-width: 400px; margin: 0 auto;">
                        {!! session()->get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>

                <div class="fixed-bottom mx-3 mb-3">
                    @if(Session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="max-width: 400px; margin: 0 auto;">
                        {!! session()->get('error') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>

                <form action="{{ route('register.login') }}" method="post" id="login" class="register-input-group">
                    @csrf
                    <input type="text" class="register-input-field" placeholder="Username" name="username" required>
                    <input type="password" class="register-input-field" placeholder="Password" name="password" required>
                    <input type="checkbox" class="register-check-box"><span>Remember me</span>
                    <button type="submit" class="register-submit-btn">Log in</button>
                </form>

                <form action="{{ route('register.store') }}" method="post" id="signup" class="register-input-group">
                    @csrf
                    <input type="text" class="register-input-field" placeholder="Username" name="username" required>
                    <input type="email" class="register-input-field" placeholder="Email" name="email" required>
                    <input type="password" class="register-input-field" placeholder="Password" name="password" required>
                    <input type="password" class="register-input-field" placeholder="Confirm Password" name="password_confirmation" required>
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
        z.style.left = "110px";
    }

    function login() {
        x.style.left = "50px";
        y.style.left = "450px";
        z.style.left = "0";
    }
</script>

</body>