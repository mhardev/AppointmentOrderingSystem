<?php include('config/dbcon.php');


session_start();


if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MOTO-JEN | Update Profile</title>
   <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<header class="header">

   <?php
   include "./pages/sections/navbar.php"
   ?>

</header>

<section class="form-container" style="padding-top: 20vmin; padding-bottom: 20vmin; min-height: 80vh;">

    <form action="" method="post">
        <h3>Update Profile</h3>
        <input type="text" required maxlength="50" name="name" placeholder="Enter your name" class="box" pattern="[a-zA-Z ]*">
        <p style="text-align:left; margin-top: 0;">+(63)<input type="tel" pattern="\d{10}" title="Please enter a 10-digit number" 
            placeholder="Enter your number" name="number" class="box" style="width: 84%; margin-left: 1.5rem;" required></p>
        <input type="text" required maxlength="100" name="address" placeholder="Enter your address" class="box" pattern="^[a-zA-Z0-9\s\-_!@#$%^&*()]*">
        <input type="submit" value="Update now" class="btn" name="submit">
        <input type="button" value="Cancel" onclick="goBack()" class="btn">
        <script>
        function goBack() {
            const referrer = document.referrer;  // Get the referring URL
            if (referrer.includes("profile.php")) {
                window.location.href = "profile.php";
            } else {
                // Default to a generic "Back" action if the referrer is unknown
                window.history.back();
            }
        }
        </script>
    </form>

</section>

<?php
if(isset($_POST['submit']))
{
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $number = isset($_POST['number']) ? $_POST['number'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;
   
    $errors = array();

    // Validate common fields (name, email, number)
    if ($name === null || empty($name)) {
        $errors[] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[] = "Name can only contain letters and spaces.";
    } elseif (strlen($name) > 50) {
        $errors[] = "Name is too long (maximum 50 characters).";
    }

    if ($number === null || empty($number)) {
        $errors[] = "Number is required.";
    } elseif (!is_numeric($number)) {
        $errors[] = "Number must be a numeric value.";
    }

    if (empty($errors)) {
        
        $updateCommonInfoSQL = "UPDATE tbl_user SET name = '$name', number = $number, address = '$address' WHERE id = $user_id";
        $updateCommonInfoResult = mysqli_query($conn, $updateCommonInfoSQL);
        if (!$updateCommonInfoResult) {
            $errors[] = "Failed to update common information.";
        }

        if (empty($errors)) {
            echo '<script>
            swal({
                title: "Success",
                text: "User Account Updated Successfully",
                icon: "success"
            }).then(function() {
                window.location = "profile.php";
            });
            </script>';
            exit;
        }
    }

    // Display errors, if any
    foreach ($errors as $error) {
        echo '<script>
        swal({
            title: "Error",
            text: "' . $error . '",
            icon: "error"
        });
        </script>';
    }
}
?>
<script src="js/script.js"></script>

</body>
</html>

<footer class="footer">
   <?php
   include "./pages/footer.php"
   ?>
</footer>