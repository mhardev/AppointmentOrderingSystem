<?php include('config/dbcon.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>MOTO-JEN | My Cart</title>
   <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
   <h3>shopping cart</h3>
   <p><a href="home.php">Home </a> <span> / Cart</span></p>
</div>

<section class="products" id="products" style="padding-top: 2vmin; min-height: 80vh;">

   <h1 class="title" data-aos="fade-right" data-aos-delay="300" data-aos-duration="3000">your cart</h1>

   <div class="box-container" >

   <?php
   //select cart query
   $grand_total = 0; 
   if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      $select_cart = "SELECT * FROM tbl_cart WHERE user_id = $user_id";
      //check the sql query executed or not
      $cart_results = mysqli_query($conn, $select_cart);
      $grand_total = 0;

      $cart_counts = mysqli_num_rows($cart_results);

      if ($cart_counts > 0) {
         while ($rowcarts = mysqli_fetch_assoc($cart_results)) {
            $id = $rowcarts['id'];
            $product_id = $rowcarts['product_id'];
            $product_qty = $rowcarts['quantity'];
            $product_name = $rowcarts['name'];
            $product_price = $rowcarts['price'];
            $image = $rowcarts['image'];

            $stock = ""; // Initialize stock variable

            $sub_total = $product_price * $product_qty; // Calculate sub total

            $grand_total += $sub_total; // Add to grand total
            
            ///stock query
            $stocksql = "SELECT product_stock FROM tbl_product WHERE id = $product_id";
            //check the query is executed or not
            $stockres = mysqli_query($conn, $stocksql);

            while ($stockrow = mysqli_fetch_assoc($stockres)) {
               $stock = $stockrow['product_stock']; // Assign the stock value

            }
            ?>
               <form action="code.php" method="POST" class="box">
                  <a href="quick_view.php?id=<?php echo $product_id; ?>" class="fas fa-eye"></a>
                  <input type="hidden" name="cart_id" value="<?php echo $id;?>">
                  <button class="fas fa-times delete_cartbtn"  type="submit" value="<?= $id;?>"  ></button>
                  <img src="images/product/<?php echo $image;?>" alt="">
                  <div class="name"><?php echo $product_name;?></div>
                  <div class="name">Stock: <?php echo $stock;?></div>
               
                  <div class="flex">
                     <div class="price" name="price" value=""><span>₱ </span><?php echo number_format($product_price, 2);?><span></span></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" value="<?php echo $product_qty ?>" />
                     <button type="submit" name="update_cart" class="fas fa-edit " value="<?= $id;?>"></button>
                     <input type="hidden" name="pid" value="<?php echo $product_id; ?>">
                     <input type="hidden" name="name" value="<?php echo $product_name; ?>">
                     <input type="hidden" name="price" value="<?php echo $product_price; ?>">
                     <input type="hidden" name="image" value="<?php echo $image; ?>">
                     <input type="hidden" name="stock" value="<?php echo $product_stock; ?>">
                     <input type="hidden" name="category" value="<?php echo $categoryname; ?>">
                  </div>
               
                  <div class="sub-total"> sub total : <span>₱<?= number_format($sub_total, 2, '.', ','); ?></span> </div>
               </form>
      <?php
         }
      }
   }
   else{
      echo '<p class="empty-message">your cart is empty</p>';
   }
   ?>
   </div>
   <div class="cart-total">
   <p>grand total : <span>₱<?= number_format($grand_total, 2, '.', ','); ?></span></p>
      <a href="checkout.php" class="btn">checkout orders</a>
      </div>
   </div>
   <form action="code.php" method="post" >
      <div class="more-btn">
      <a href="#" class="delete-btn deleteall-btn" value="<?= $id;?>">delete all</a>
      </div>
      </form>

</section>


<?php
   
?>

<script src="js/script.js"></script>
<script src="js/custom.del.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
   AOS.init();
 </script>

</body>
</html>

<footer class="footer">
   <?php
   include "./pages/footer.php"
   ?>
</footer>