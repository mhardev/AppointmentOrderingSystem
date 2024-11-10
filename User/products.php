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
   <title>MOTO-JEN | Products</title>
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
   <h3>Products</h3>
   <p><a href="home.php">Home </a> <span> / Products</span></p>
</div>

<section class="products">
    <h1 class="title" data-aos="fade-right" data-aos-delay="300" data-aos-duration="3000">Product List</h1>

    <div class="box-container">
        <?php
        $recordsPerPage = 12; // Number of records to display per page

        // Get the current page from the URL
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Calculate the offset based on the current page
        $offset = ($currentPage - 1) * $recordsPerPage;

        // Select products with LIMIT and OFFSET
        $sql = "SELECT * FROM tbl_product LIMIT $recordsPerPage OFFSET $offset";
        $res = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($res)) {
            $pid = $row['id'];
            $product_name = $row['product_name'];
            $image = $row['image'];
            $product_category = $row['product_category'];
            $product_stock = $row['product_stock'];
            $product_price = $row['product_price'];

            ?>

         <form accept="" method="post" class="box">
         <a href="quick_view.php?id=<?php echo $pid; ?>" class="fas fa-eye"></a>
         <button class="fas fa-shopping-cart" type="submit" name="add_to_cart"></button>
         <img src="images/product/<?php echo $image;?>" alt="">
         <a href="category.php" class="cat"><?php echo $product_category;?></a>
         <div class="name"><?php echo $product_name;?></div>
         <div class="flex">
               <div class="price" name="price" value=""><span>₱ </span><?php echo number_format($product_price, 2);?><span></span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
               <input type="hidden" name="pid" value="<?php echo $pid; ?>">
               <input type="hidden" name="name" value="<?php echo $product_name; ?>">
               <input type="hidden" name="price" value="<?php echo $product_price; ?>">
               <input type="hidden" name="image" value="<?php echo $image; ?>">
               <input type="hidden" name="stock" value="<?php echo $product_stock; ?>">
               <input type="hidden" name="category" value="<?php echo $product_category; ?>">
         </div>
      </form>



            <?php
         }
   // Create pagination links
   $sqlTotal = "SELECT COUNT(*) AS total FROM tbl_product";
   $resTotal = mysqli_query($conn, $sqlTotal);
   $rowTotal = mysqli_fetch_assoc($resTotal);
   $totalProducts = $rowTotal['total'];
   $totalPages = ceil($totalProducts / $recordsPerPage);
   ?>
</div>

</section>

<div class="pagination">
    <?php if ($currentPage > 1) : ?>
        <a href="products.php?page=<?php echo $currentPage - 1; ?>" class="pagination-link">&laquo; Prev</a>
    <?php endif; ?>

    <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
        <a href="products.php?page=<?php echo $page; ?>" class="pagination-link <?php if ($page === $currentPage) echo 'active'; ?>">
            <?php echo $page; ?>
        </a>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages) : ?>
        <a href="products.php?page=<?php echo $currentPage + 1; ?>" class="pagination-link">Next &raquo;</a>
    <?php endif; ?>
</div>

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
              $cartinsert = "INSERT INTO tbl_cart SET name = '$product_name', user_id = '$user_id', product_id = '$pid', product_category = '$categoryname', price = '$product_price', quantity = '$qty', image = '$image'";
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