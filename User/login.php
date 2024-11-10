<?php 
session_start();
include('config/dbcon.php');
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MOTO-JEN | Login</title>
   <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
   /* Style for the container */
        .password-container {
            position: relative;
        }

        /* Style for the toggle icon */
        .toggle-password {
            position: absolute;
            right: 10px; /* Adjust the right value to control the icon's position */
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>

</head>
<body>
<header class="header">
        <?php
            include "./pages/sections/navbar.php"
        ?>
    </header>
    <section class="form-container" style="padding-top: 20vmin; padding-bottom: 20vmin; min-height: 80vh;">
        <form method="POST">
            <h3>Login now</h3>
            <input type="email" required maxlength="50" name="email" placeholder="enter your email" class="box">
            <div class="password-container">
            <input type="password" required maxlength="20" name="password" placeholder="enter your password" class="box" id=passwordInput>
                <span toggle="#passwordInput" class="toggle-password"><i class="far fa-eye"></i></span>
            </div>
            <input type="submit" value="login now" class="btn" name="login">
            <p>Don't have an account? <a href="register.php">register now</a></p>
        </form>
    </section>
    
    <?php
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, password, email_verified_at FROM tbl_user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $hashedPassword, $email_verified_at);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($password, $hashedPassword)) {
            if ($email_verified_at == null) {
                echo '<script>
                swal({
                    title: "Error",
                    text: "Please verify your email",
                    icon: "error"
                }).then(function() {
                    window.location = "verify.php?email=' . $email . '";
                });
                </script>';
                exit;
            }

            // User is authenticated
            $_SESSION['user_id'] = $id;
            echo '<script>
            swal({
                title: "Success",
                text: "Login Successfully",
                icon: "success"
            }).then(function() {
                window.location = "home.php";
            });
            </script>';
            exit;
        } else {
            // User not available or password doesn't match
            echo '<script>
            swal({
                title: "Error",
                text: "Username or Password did not match",
                icon: "error"
            }).then(function() {
                window.location = "login.php";
            });
            </script>';
            exit;
        }
    }
    ?>
    <script>
        // Toggle password visibility
        $(".toggle-password").click(function() {
            var selector = $(this).attr("toggle");
            var input = $(selector);
            input.attr("type") === "password" ? input.attr("type", "text") : input.attr("type", "password");
        });
    </script>

    <script scr="js/script.js"></script>
</body>
</html>

<footer class="footer">
    <?php
        include "./pages/footer.php"
    ?>
</footer>
