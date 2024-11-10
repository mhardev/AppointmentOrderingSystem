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
   <title>MOTO-JEN | Verification</title>
   <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<section class="form-container" style="padding-top: 40vmin; padding-bottom: 20vmin; min-height: 90vh;">

    <form action="" method="POST">
        <h3>Verification</h3>
        <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required class="box" />
        <input type="text" name="otp_code" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" 
        placeholder="Enter verification code" required class="box" style="width: 58%; margin-right: 1.2rem;">
        
        <input type="submit" name="verify_email" value="Verify Email" class="btn">
    </form>

</section>
<?php
if (isset($_POST["verify_email"])) {
    $email = $_POST["email"];
    $otp_code = $_POST["otp_code"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE tbl_user SET status = 'Active', email_verified_at = NOW() WHERE email = ? AND otp_code = ?");
    $stmt->bind_param("ss", $email, $otp_code);
    $stmt->execute();
    $affected_rows = $stmt->affected_rows;
    $stmt->close();

    if ($affected_rows == 0) {
        echo "<script>
        $(document).ready(function() {
            swal('Error', 'Incorrect OTP code').then(function() { 
                window.location = 'verify.php?email=" . $email . "'; 
            }); 
        });
        </script>";
        exit();
    }

    echo "<script>
    $(document).ready(function() {
        swal('Success', 'Verified Successfully!', 'success').then(function() {
            window.location = 'login.php';
        });
    });
    </script>";
    exit();
}
?>



<script href="js/script.js"></script>
</body>
</html>

<<footer class="footer">
    <?php
        include "./pages/footer.php"
    ?>
</footer>

