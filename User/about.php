<?php include('config/dbcon.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MOTO-JEN | About Us</title>
   <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!---Aos animation link-->

   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


</head>
<body>
   
<header class="header">

   <?php
   include "./pages/sections/navbar.php"
   ?>

</header>

<div class="heading">
   <h3>about us</h3>
   <p><a href="about.php">Home </a> <span> / About</span></p>
</div>

<section class="about">

   <div class="row">

      <div  class="image" data-aos="fade-up-right" data-aos-delay="300" data-aos-duration="3000">
         <img  src="images/motojensvg1.png" alt="">
      </div>
 

      <div class="content" data-aos="fade-left" data-aos-delay="300" data-aos-duration="3000">
         <h3>why choose us?</h3>
         <p style="text-align: justify;">At MOTO-JEN, we are dedicated to delivering the genuine quality of motor parts and services right to your workshop or doorstep. Our user-friendly Motor Parts and Services Ordering Website is designed to fulfill your automotive needs with ease, providing you with top-notch products and assistance at your fingertips. </p>
         <a href="products.php" class="btn">Our Products</a>
      </div>
   </div>
</section>

<section class="steps">

   <h1 class="title" data-aos="fade-up-right" data-aos-delay="300" data-aos-duration="3000">3 simple steps</h1>

   <div class="box-container">

      <div class="box" data-aos="fade-up" data-aos-delay="300" data-aos-duration="3000">
         <img src="images/step-1.png" alt="">
         <h3>select product</h3>
         <p style="text-align: justify;">Choose from our extensive range of motor parts products, where each component speaks of quality and reliability.</p>
      </div>

      <div class="box" data-aos="fade-down" data-aos-delay="300" data-aos-duration="3000">
         <img src="images/step-2.png" alt="">
         <h3>Ready to pickup</h3>
         <p style="text-align: justify;">Experience the convenience of swift motor part, bringing top-notch quality directly in our shop.</p>
      </div>

      <div class="box" data-aos="fade-left" data-aos-delay="300" data-aos-duration="3000">
         <img src="images/enjoy.png" alt="">
         <h3>enjoy our product & services!</h3>
         <p style="text-align: justify;">Delight in the satisfaction of experiencing our products and services, crafted with dedication and delivered with utmost care.</p>
      </div>

   </div>

</section>

<?php
include "./pages/sections/maps.php"
?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
   AOS.init();
 </script>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor:true,
            spaceBetween: 20,
            autoplay: {
         delay: 3000, // Time in milliseconds between each slide
      },
   pagination: {
      el: ".swiper-pagination",
   },
   breakpoints: {
      550: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>

<footer class="footer">
   <?php
   include "./pages/footer.php"
   ?>
</footer>
