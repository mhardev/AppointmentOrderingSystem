<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="icon" href="Root/img/motojenlogofinal.png" type="image/x-icon">
    <title>Admin Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="Root/css/adminlogin.css">
</head>

<body>
<div class="box-container">
    <div class="box-image">
        <img src="Root/img/motojen-logo.png" alt="">
    </div>
    <div class="box-login">
        <h1>Admin login</h1>
        <form method="POST">
            <div class="input-container">
                <i class="material-icons-sharp">person</i>
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="input-container">
                <i class="material-icons-sharp">lock</i>
                <input type="password" name="password" id="password" placeholder="Password">
                <span class="toggle-password" onclick="togglePasswordVisibility()" >
                <i class="material-icons-sharp" id="password-icon">visibility</i>
                </span>
            </div>
            <input type="submit" name="login-submit" value="Login" class="submit-button">
        </form>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggleSpan = document.querySelector(".toggle-password");
        var passwordIcon = document.getElementById("password-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordIcon.textContent = "visibility_off";
        } else {
            passwordInput.type = "password";
            passwordIcon.textContent = "visibility";
        }
    }
</script>
</body>
</html>
<?php
    include('Validations/login.php');
?>
