<body>
    
@include("includes.navigation")

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

@include('includes.footer')
</body>
