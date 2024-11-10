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
   <title>MOTO-JEN | My Profile</title>
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

<div class="heading">
   <h3>my profile</h3>
   <p><a href="home.php">Home </a> <span> / Profile</span></p>
</div>

<section class="user-details" style="padding-top: 2vmin;">

<?php
if(isset($_SESSION['user_id']))
{ 
   $user_id = $_SESSION['user_id'];
      $sql = "SELECT * FROM tbl_user WHERE id = $user_id";

      //execute thr query
      $res = mysqli_query($conn,$sql);

      //count the rows
      $count =  mysqli_num_rows($res);

      //if the num rows is greater than 0 it means they have data
      if($count>0)
      {
            //fetch the row data from database
            while($row = mysqli_fetch_assoc($res))
            {
               $name = $row['name'];
               $email = $row['email'];
               $number = $row['number'];
               $address = $row['address'];

               ?>
               <div class="user">
                  <img src="images/user-icon.png" alt="">
                  <p><i class="fas fa-user"></i> <span><?php echo $name;?></span></p>
                  <p><i class="fas fa-phone"></i> <span><?php echo $number;?></span></p>
                  <p><i class="fas fa-envelope"></i> <span><?php echo $email;?></span></p>
                  <p class="address"><i class="fas fa-map-marker-alt"></i> <span><?php echo $address;?></span></p>
                  <a href="update_profile.php" class="btn">update profile</a>
                  <h1 class="title" style="font-size:30px; padding-top:5vmin;" >Transaction History</h1>
                  <a href="appointmentHistory.php" class="btn" style="text-align:center;">View Appointment History</a>
                  <a href="ordersHistory.php" class="btn" style="text-align:center;">View Order History</a>
               </div>
               <?php
            }
      }
}
?>

   

</section>

<script src="js/script.js"></script>

</body>
</html>

<footer class="footer">
   <?php
   include "./pages/footer.php"
   ?>
</footer>