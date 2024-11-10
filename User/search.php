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
   <title>MOTO-JEN | Search page</title>
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

<section class="search-form">
    <form action="" method="post">
        <input type="text" class="box" name="search_box" placeholder="search here..." maxlength="100">
        <button type="submit" class="fas fa-search" name="search_btn"></button>
    </form>
</section>

<section class="products" style="padding-top: 0; min-height: 100vh;">
    <div class="box-container">
        <?php
        $recordsPerPage = 15; // Number of products to display per page
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page from the URL

        if (isset($_POST['search_box']) || isset($_POST['search_btn'])) {
            $search_box = $_POST['search_box'];
            $search_term = '%' . $search_box . '%';
            // Query for counting the total results
            $countQuery = $conn->prepare("SELECT COUNT(*) as total FROM `tbl_product` WHERE product_name LIKE ?");
            $countQuery->bind_param('s', $search_term);
            $countQuery->execute();
            $countResult = $countQuery->get_result();
            $countRow = $countResult->fetch_assoc();
            $totalResults = $countRow['total'];
            $totalPages = ceil($totalResults / $recordsPerPage);

            // Create a prepared statement for the main query
            $select_products = $conn->prepare("SELECT * FROM `tbl_product` WHERE product_name LIKE ? LIMIT ? OFFSET ?");
            $offset = ($currentPage - 1) * $recordsPerPage;
            $select_products->bind_param('sii', $search_term, $recordsPerPage, $offset);
            $select_products->execute();
            $result = $select_products->get_result();

            if ($result->num_rows > 0) {
                while ($fetch_product = $result->fetch_assoc()) {
                ?>
                <form action="" method="post" class="box">
                    <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                    <input type="hidden" name="name" value="<?= $fetch_product['product_name']; ?>">
                    <input type="hidden" name="price" value="<?= $fetch_product['product_price']; ?>">
                    <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">
                    <a href="quick_view.php?id=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                    <img src="images/product/<?= $fetch_product['image']; ?>" alt="">
                    <div class="name"><?= $fetch_product['product_name']; ?></div>
                    <div class="flex">
                        <div class="price"><span>₱</span><?= number_format($fetch_product['product_price'], 2, '.', ','); ?><span></span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                    </div>
                    <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                </form>
                <?php
            }
        } else {
            echo '<p class="empty">no products found!</p>';
        }
    }
    ?>
</div>
</section>

<div class="pagination">
    <?php if ($currentPage > 1) : ?>
        <a href="search.php?page=<?php echo $currentPage - 1; ?>&search_box=<?php echo $search_box; ?>" class="pagination-link">&laquo; Prev</a>
    <?php endif; ?>

    <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
        <a href="search.php?page=<?php echo $page; ?>&search_box=<?php echo $search_box; ?>" class="pagination-link <?php if ($page === $currentPage) echo 'active'; ?>">
            <?php echo $page; ?>
        </a>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages) : ?>
        <a href="search.php?page=<?php echo $currentPage + 1; ?>&search_box=<?php echo $search_box; ?>" class="pagination-link">Next &raquo;</a>
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
                  text: "Failed to check food availability",
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




<footer class="footer">

   

   <div class="credit">&copy; copyright @ 2023 by <span>Motojen</span> | all rights reserved!</div>

</footer>

<script src="js/script.js"></script>

</body>
</html>