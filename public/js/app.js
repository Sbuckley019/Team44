function signup() {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var con_password = document.getElementById("password").value;

    if (!username || !email || !password || !con_password) {
        alert("Please fill in all fields.");
        return;
    }
    alert(
        "Sign up successful! (Note: This is a basic example; implement server-side registration in a real project)"
    );
}
