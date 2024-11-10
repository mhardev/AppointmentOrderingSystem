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
   <title>MOTO-JEN | Homepage</title>
   <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

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

<section class="home">

   <div class="swiper home-slider">

      <div class="swiper-wrapper">

      
      <div class="swiper-slide slide">
            <div class="content">
               
               <h3>Motor Tires</h3>
               <a href="products.php" class="btn">See Products</a>
            </div>
            <div class="image">
               <img src="images/tiresnew.png" alt="">
            </div>
         </div>

   

         <div class="swiper-slide slide">
            <div class="content">
               
               <h3>Motor Bearing</h3>
               <a href="products.php" class="btn">See Products</a>
            </div>
            <div class="image">
               <img src="images/bearing.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
             
               <h3>Motolight</h3>
               <a href="products.php" class="btn">See Products</a>
            </div>
            <div class="image">
               <img src="images/motolight.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               
               <h3>Chain Sprocket</h3>
               <a href="products.php" class="btn">See Products</a>
            </div>
            <div class="image">
               <img src="images/chainsproket.png" alt="">
            </div>
         </div>

         

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<section class="category">

   <h1 class="title" data-aos="fade-right" data-aos-delay="300" data-aos-duration="3000">Motorparts Category</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?product_category=oil" class="swiper-slide slide">
      <img src="images/oil-icon.png" alt="">
      <h3>Oil</h3>
   </a>

   <a href="category.php?product_category=engine" class="swiper-slide slide">
      <img src="images/engine-icon.png" alt="">
      <h3>Engine</h3>
   </a>

   <a href="category.php?product_category=frame" class="swiper-slide slide">
      <img src="images/frame-icon.png" alt="">
      <h3>Frame</h3>
   </a>

   <a href="category.php?product_category=battery" class="swiper-slide slide">
      <img src="images/battery-icon.png" alt="">
      <h3>Battery</h3>
   </a>



   

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="products">

   <h1 class="title" data-aos="fade-right" data-aos-delay="300" data-aos-duration="3000">latest Product Item</h1>

   <div class="swiper product-slider">
      <div class="swiper-wrapper">
         <?php
         $cartquery = "SELECT * FROM tbl_cart";

         //cartresukt
         $cartresult = mysqli_query($conn,$cartquery);
         $cartcount = mysqli_num_rows($cartresult);
         if($cartcount>0)
         {
            while($cartrow = mysqli_fetch_assoc($cartresult))
            {
               $idd = $cartrow['id'];
            }
         }
         ?>
         

         <?php
            //create sql query to display the food on front-end
            $foodisplayquery = "SELECT * FROM tbl_product ORDER BY id DESC";

            //check the sql query if executed or not
            $foodresult = mysqli_query($conn,$foodisplayquery);

            //count the numrows
            $foodcount = mysqli_num_rows($foodresult);

            if($foodcount>0)
            {
               while($foodrow = mysqli_fetch_assoc($foodresult))
               {
                  $pid = $foodrow['id'];
                  $product_name = $foodrow['product_name'];
                  $product_price = $foodrow['product_price'];
                  $product_stock = $foodrow['product_stock'];
                  $image = $foodrow['image'];
                  $categoryname = $foodrow['product_category']; 
                  $_SESSION['pid'] = $foodrow['id'];

                  ?>

         <div class="box-container swiper-slide slide">

         <form accept="" method="post" class="box">
            <a href="quick_view.php?id=<?php echo $pid; ?>" class="fas fa-eye"></a>
            <button class="fas fa-shopping-cart"  type="submit" name="add_to_cart"></button>
            <img src="images/product/<?php echo $image;?>" alt="">
            <a href="category.php"  class="cat"><?php echo $categoryname;?></a>
            <div class="name"  ><?php echo $product_name;?></div>
            <div class="name">Stock: <?php echo $product_stock;?> </div>
            <div class="flex">
               <div class="price" name="price" value=""><span>₱ </span><?php echo number_format($product_price, 2);?><span></span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
               <input type="hidden" name="pid" value="<?php echo $pid; ?>">
               <input type="hidden" name="name" value="<?php echo $product_name; ?>">
               <input type="hidden" name="price" value="<?php echo $product_price; ?>">
               <input type="hidden" name="image" value="<?php echo $image; ?>">
               <input type="hidden" name="stock" value="<?php echo $product_stock; ?>">
               <input type="hidden" name="category" value="<?php echo $categoryname; ?>">
            </div>
         </form>


         </div>


                  <?php

               }
            }
         
         ?>
      </div>
   </div>
</section>
<?php


if (isset($_POST['add_to_cart'])) {
    $user_id = $_SESSION['user_id'] ?? ''; // Use null coalescing operator to set default value

    if (empty($user_id)) {
        // Redirect if user is not logged in
        echo '<script>
            swal({
                title: "Error",
                text: "You need to be logged in to add items to the cart",
                icon: "error"
            }).then(function() {
                window.location = "login.php";
            });
        </script>';
        exit;
    } else {
      $pid = $_POST['pid'];
      $product_name = $_POST['name'];
      $product_price = $_POST['price'];
      $product_stock = $_POST['stock'];
      $categoryname = $_POST['category'];
      $qty = $_POST['qty'];
      $image = $_POST['image'];

      // Stock query
      $check_stock = "SELECT product_stock FROM tbl_product WHERE id = $pid";
      
      // Check the stock query execution
      $stock_result = mysqli_query($conn, $check_stock);

      if ($stock_result) {
          $stock_row = mysqli_fetch_assoc($stock_result);
          $available_stock = $stock_row['product_stock'];

          if ($available_stock <= 0) {
              echo '<script>
                  swal({
                      title: "Error",
                      text: "Sorry, this product is not available right now",
                      icon: "error"
                  }).then(function() {
                      window.location = "home.php";
                  });
              </script>';
              exit;
          } else {
              // Continue with adding to cart
              $cartinsert = "INSERT INTO tbl_cart SET name = '$product_name', user_id = '$user_id', product_id = '$pid', price = '$product_price', quantity = '$qty', image = '$image'";
              $cartresult = mysqli_query($conn, $cartinsert);

              if ($cartresult) {
                  echo '<script>
                      swal({
                          title: "Success",
                          text: "Product Successfully Added to cart",
                          icon: "success"
                      }).then(function() {
                          window.location = "cart.php";
                      });
                  </script>';
                  exit;
              } else {
                  echo '<script>
                      swal({
                          title: "Error",
                          text: "Product Failed to be Added to cart",
                          icon: "error"
                      }).then(function() {
                          window.location = "login.php";
                      });
                  </script>';
                  exit;
              }
          }
      } else {
          echo '<script>
              swal({
                  title: "Error",
                  text: "Failed to check Product availability",
                  icon: "error"
              }).then(function() {
                  window.location = "home.php";
              });
          </script>';
          exit;
      }
    }
}
?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
   AOS.init();
 </script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   grabCursor:true,
   effect: "flip",
   autoplay: {
         delay: 3000, // Time in milliseconds between each slide
      },
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   autoplay: {
         delay: 3000, // Time in milliseconds between each slide
      },
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});
var swiper = new Swiper('.product-slider', {
   slidesPerView: 3,   // Default number of slides
   spaceBetween: 3,   // Space between slides
   autoplay: {
         delay: 3000, // Time in milliseconds between each slide
      },
   pagination: {
      el: '.swiper-pagination',
      clickable: true,
   },

   breakpoints: {
      // Breakpoint for screens with width less than 650px
      0: {
         slidesPerView: 1,
      },
      // Breakpoint for screens with width between 650px and 767px
      650: {
         slidesPerView: 2,
      },
      // Breakpoint for screens with width between 768px and 1023px
      900: {
         slidesPerView: 3,
      },
      // Breakpoint for screens with width equal to or greater than 1024px
     
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