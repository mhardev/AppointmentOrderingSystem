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
   <title>MOTO-JEN | Quick View</title>
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


<section class="quick-view">
    <h1 style="font-size: 34px; ">quick view</h1>
    <?php
    $pid = $_GET['id'];
    $select_products = $conn->prepare("SELECT * FROM `tbl_product` WHERE id = ?"); 
    $select_products->bind_param("i", $pid); // Bind the parameter
    $select_products->execute();
    $result = $select_products->get_result();

    if($result->num_rows > 0){
        while($fetch_product = $result->fetch_assoc()){
        ?>

    <form action="" method="post" class="box">
        <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
        <input type="hidden" name="name" value="<?= $fetch_product['product_name']; ?>">
        <input type="hidden" name="price" value="<?= $fetch_product['product_price']; ?>">
        <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">
        <input type="hidden" name="stock" value="<?= $fetch_product['product_stock']; ?>">
        <input type="hidden" name="category" value="<?= $fetch_product['product_category']; ?>">
        <div class="row">
            <div class="image-container">
                <div class="main-image">
                <img src="images/product/<?= $fetch_product['image']; ?>" alt="">
                </div>

            </div>
            <div class="content">
                <div class="name"><?= $fetch_product['product_name']; ?></div>
                <div class="flex">
                <div class="price"><span>₱</span><?= number_format($fetch_product['product_price'], 2, '.', ','); ?><span></span></div>
                <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                </div>
                <div class="stock">Stock: <?= $fetch_product['product_stock']; ?></div>
                <style>
                .stock{
                    font-size: 15px;
                }
                </style>
                <div class="flex-btn">
                <input type="submit" value="Add to cart" class="btn" name="add_to_cart">
                <input type="button" value="Back" onclick="goBack()" class="btn">

                <script>
                function goBack() {
                    const referrer = document.referrer;  // Get the referring URL
                    if (referrer.includes("products.php")) {
                        window.location.href = "products.php";
                    } else if (referrer.includes("search.php")) {
                        window.location.href = "search.php";
                    } else if (referrer.includes("category.php")) {
                        window.location.href = "category.php";
                    } else {
                        // Default to a generic "Back" action if the referrer is unknown
                        window.history.back();
                    }
                }
                </script>
                </div>
            </div>
        </div>
    </form>
    <?php
        }
    } else {
        echo '<p class="empty">no products added yet!</p>';
    }
    ?>
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
                      return;
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
                  text: "Failed to check product availability",
                  icon: "error"
              }).then(function() {
                  return;
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

</body>
</html>

<footer class="footer">
   <?php
   include "./pages/footer.php"
   ?>
</footer>