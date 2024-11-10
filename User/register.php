<?php include('config/dbcon.php');
session_start();
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
   <title>MOTO-JEN | Register</title>
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
    <section class="form-container" style="padding-top: 18vmin; padding-bottom: 20vmin; min-height: 80vh;">

        <form action="" method="POST">
            <h3>Register now</h3>
            <input type="text" required maxlength="50" name="name" placeholder="Enter your name" class="box">
            <input type="email" required maxlength="50" name="email" placeholder="Enter your email" class="box">
            <input type="text" required maxlength="100" name="address" placeholder="Enter your address" class="box" pattern="^[a-zA-Z0-9\s\-_!@#$%^&*()]*">
            <p style="text-align:left; margin-top: 0;">+(63)<input type="tel" pattern="\d{10}" title="Please enter a 10-digit number" 
            placeholder="Enter your number" name="phone_number" class="box" style="width: 84%; margin-left: 1.5rem;" required></p>
            <span>
                <i>Note: The password should at least 8 characters with at least one uppercase letter, 
                    one lowercase letter, one number, and one special character.</i></span>
            <div class="password-container">
                <input type="password" required maxlength="20" name="password" placeholder="Enter your password" class="box" id="passwordInput">
                <span toggle="#passwordInput" class="toggle-password"><i class="far fa-eye"></i></span>
            </div>
            <div class="password-container">
                <input type="password" maxlength="20" name="c_password" placeholder="Confirm your password" class="box" id="confirmPasswordInput" required>
                <span toggle="#confirmPasswordInput" class="toggle-password"><i class="far fa-eye"></i></span>
            </div>
            <input type="submit" value="Register Now" class="btn" name="register">
            <p>Already have an account? <a href="login.php">Login now</a></p>
        </form>

    </section>
    <?php
    
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
    
        //Load Composer's autoloader
        require 'vendor/autoload.php';
    
        if (isset($_POST["register"]))
        {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $c_password = $_POST["c_password"];
            $phone_number = $_POST["phone_number"];
            $address = $_POST["address"];
            
            // Password validation
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                echo "<script>
                $(document).ready(function() { 
                    swal('Error', 'Password should be at least 8 characters in length and should include at least one uppercase letter, 
                    one lowercase letter, one number, and one special character.', 'error').then(function() { 
                        return; 
                    }); 
                });
                </script>";
                exit();
            }

            if ($password !== $c_password) {
                echo "<script>
                $(document).ready(function() { 
                    swal('Error', 'Password does not matched.', 'error').then(function() { 
                        return; 
                    }); 
                });</script>";
                exit();
            }

            $check_email_query = "SELECT * FROM tbl_user WHERE email = '$email'";
            $check_email_result = mysqli_query($conn, $check_email_query);

            if (mysqli_num_rows($check_email_result) > 0) {
                echo "<script>
                $(document).ready(function() { 
                    swal('Error', 'Email already in use. Please use a different email address.', 'error').then(function() { 
                        return; 
                    }); 
                });</script>";
                exit();
            }

            //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
    
            try {
                //Enable verbose debug output
                $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;


                // Send using SMTP
                $mail->isSMTP();

                // Set the SMTP server to send through
                $mail->Host = 'smtp.gmail.com';

                // Enable SMTP authentication
                $mail->SMTPAuth = true;

                // SMTP username
                $mail->Username = 'uekiaki3@gmail.com';

                // SMTP password
                $mail->Password = 'eqrtuxtkeuoqhgal';

                // Enable TLS encryption;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('no-reply@moto-jen.online', 'MOTO-JEN App');

                // Add a recipient
                $mail->addAddress($email, $name);

                // Set email format to HTML
                $mail->isHTML(true);

                $otp_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

                $mail->Subject = 'Email verification';
                $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $otp_code . '</b></p>';

                $mail->send();
                    // echo 'Message has been sent';
    
                $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert user into the database
                $sql = "INSERT INTO tbl_user(name, email, number, address, password, status, otp_code, email_verified_at) VALUES ('$name', '$email', '$phone_number', '$address', '$encrypted_password', NULL, '$otp_code', NULL)";

                mysqli_query($conn, $sql);
        
                echo "<script>
                $(document).ready(function() {
                    swal('Success', 'Proceed to verification!', 'success').then(function() {
                        window.location = 'verify.php?email=" . $email . "';
                    });
                });</script>";
                exit();
            } catch (Exception $e) {
                echo "<script>
                $(document).ready(function() {
                    swal('Error', 'Message could not be sent. Mailer Error: {$mail->ErrorInfo}', 'error').then(function() {
                        window.location = 'login.php';
                    });
                });</script>";
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
    <script src="js/script.js"></script>
</body>
</html>

<footer class="footer">
    <?php
        include "./pages/footer.php"
    ?>
</footer>


