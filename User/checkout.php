<?php include('config/dbcon.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOTO-JEN | Checkout</title>
    <link rel="icon" type="image/x-icon" href="images/motojenlogofinal.png">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/qrcode.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <h3>checkout</h3>
        <p><a href="home.php">home </a> <span> / checkout</span></p>
    </div>

    <section class="checkout">
        <form action="" method="post" enctype="multipart/form-data" data-aos="fade-up-right" data-aos-delay="300" data-aos-duration="3000">
            <h1 class="title" data-aos="fade-right" data-aos-delay="300" data-aos-duration="3000">Order Summary</h1>

            <?php
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                // Fetch Cart Items
                $cartsql = "SELECT * FROM tbl_cart WHERE user_id = $user_id"; // Assuming the user_id is a column in tbl_cart
                $cartresult = mysqli_query($conn, $cartsql);

                // Fetch User Information and Delivery Address
                $usersql = "SELECT * FROM tbl_user WHERE id = $user_id";
                $useres = mysqli_query($conn, $usersql);

                if ($cartresult && $useres) {
                    $grandTotal = 0; // Initialize the grand total
                    $cart_items = '';

                    echo '<div class="cart-items">';
                    echo '<h3>Cart Items</h3>';

                    while ($cartrow = mysqli_fetch_assoc($cartresult)) {
                        $quantity = $cartrow['quantity'];
                        $price = $cartrow['price'];
                        $totalPrice = $quantity * $price;
                        $grandTotal += $totalPrice; // Add to the grand total

                        $cart_items .= $cartrow['name'] . ' (' . $cartrow['price'] . ' x ' . $cartrow['quantity'] . ') - ';
                    }

                    echo '<p>';
                    echo '<span class="name">Product name: ' . $cart_items . '</span>';
                    echo '<span class="price">₱' . $grandTotal . '</span>';
                    echo '</p>';
                    echo '<a href="cart.php" class="btn">View Cart</a>';
                    echo '</div>';

                    if ($user_row = mysqli_fetch_assoc($useres)) {
                        $name = $user_row['name'];
                        $email = $user_row['email'];
                        $address = $user_row['address'];                    }
                }
            }
            ?>
            <div class="user-info">
                <h3>Your Info</h3>
                <p><i class="fas fa-user"></i> <span><?php echo $name ?></span></p>
                <p><i class="fas fa-envelope"></i> <span><?php echo $email ?></span></p>
                <p class="address"><i class="fas fa-map-marker-alt"></i> <span><?php echo $address ?></span></p>
                <h3>Payment Type:</h3>
                <select name="paymentType" class="box" id="paymentType" required>
                    <option value="" selected>Select payment type</option>
                    <option value="Full">Full Payment</option>
                    <option value="Down">Down Payment</option>
                </select>
                <h3>Payment Method:</h3>
                <select name="paymentMethod" class="box" id="paymentMethod" required disabled>
                    <option value="" disabled selected>Select payment method</option>
                    <option value="pickup" id="pickup">Pay via Pick Up</option>
                    <option value="Gcash">Pay via Gcash (QR Code)</option>
                    <option value="Maya">Pay via Maya (QR Code)</option>
                </select>
                <img src="images/qrcode_gcash.jpg" alt="qrcode" id="gcashQR" style="display: none;" class="center">
                <img src="images/qrcode.png" alt="qrcode" id="mayaQR" style="display: none;" class="center">
                <h3>Amount:</h3>
                <span style="font-style:italic">*Noted: You should input at least 20% of your down payment*</span>
                <input type="number" class="box" name="payment" id="amount" required>
                <h3>Reference Number:</h3>
                <input type="text" class="box" id="referenceNo" name="referenceNo">
                <h3>Upload Proof:</h3>
                <input type="file" id="proofImg" name="image" accept="image/*">
            </div>
            <script>
                $(document).ready(function(){
                    $("#qrcode").css('display', 'none');
                    $("#paymentType").on('change',function(){
                        if($("#paymentType").val() == "Full"){
                            $("#paymentMethod").prop('disabled',false)
                            $("#amount").val(<?php echo $grandTotal ?>)
                            $("#amount").attr('readonly',true)
                            $('#amount').css('color', 'gray'); 
                            $("#pickup").prop('disabled',false)
                        }else if($("#paymentType").val() == "Down"){
                            $("#paymentMethod").prop('disabled',false)
                            $("#amount").val(0)
                            $("#amount").attr('readonly',false)
                            $("#pickup").prop('disabled',true)
                        }else if ($("#paymentType").val() == ""){
                            $("#paymentMethod").prop('disabled',true)
                        }
                    })

                    $("#paymentMethod").on('change',function(){
                        if($("#paymentMethod").val() == "pickup"){
                            $("#qrcode").css('display', 'none');
                            $("#referenceNo").prop('disabled',true)
                            $('#referenceNo').css('color', 'gray');
                            $("#referenceNo").prop('disabled',true)
                            $("#proofImg").removeAttr('required')
                            $("#proofImg").prop('disabled',true)
                            $('#proofImg').css('color', 'gray');
                            $("#referenceNo").removeAttr('required')
                        }else if($("#paymentMethod").val() == "Gcash"){
                            $("#proofImg").prop('disabled',false)
                            $("#qrcode").css('display', 'block');
                            $("#referenceNo").prop('disabled',false)
                            $("#proofImg").attr('required','required')
                            $("#referenceNo").attr('required','required')
                        }else if($("#paymentMethod").val() == "Maya"){
                            $("#proofImg").prop('disabled',false)
                            $("#qrcode").css('display', 'block');
                            $("#referenceNo").prop('disabled',false)
                            $("#proofImg").attr('required','required')
                            $("#referenceNo").attr('required','required')
                        }else{
                            $("#qrcode").css('display', 'none');
                        }
                    })
                });
            </script>
            <input type="submit" value="Place Order" name="order" class="btn order-btn">
        </form>
    </section>

    <?php

    if (isset($_POST['order'])) {
        $payment_method = $_POST['paymentMethod'];
        $referenceNo = $_POST['referenceNo'];
        $payment = $_POST['payment'];
        $paymentType = $_POST['paymentType'];
        $remainingbal = $grandTotal - $payment;

        //upload the image if selected
        if (isset($_FILES['image']['name'])) {
            //get the details of the selected image
            $image_name = $_FILES['image']['name'];

            //check if the imaage selected or not.
            if ($image_name != "") {
                // Image is selected
                // Rename the image
                $ext_parts = explode('.', $image_name);
                $ext = end($ext_parts);

                // Create a new name for the image
                $image_name = "Uservalid-Pic" . rand(0000, 9999) . "." . $ext;

                // Upload the image

                // Get the src path and destination path

                // Source path is the current location of the image
                $src = $_FILES['image']['tmp_name'];

                // Destination path for the image to be uploaded
                $destination = "../Root/img/ProductOrderProofs/" . $image_name;

                // Upload the food image
                $upload = move_uploaded_file($src, $destination);

                // Check if the image uploaded or not
                if ($upload == false) {
                    // Failed to upload the image
                    echo '<script>
                        swal({
                            title: "Error",
                            text: "Failed to upload image",
                            icon: "error"
                        }).then(function() {
                            window.location = "checkout.php";
                        });
                    </script>';
                    die();
                } else {
                    // Image uploaded successfully
                }
            }
        } else {
            $image_name = "";
        }

        $select_cart = "SELECT * FROM tbl_cart WHERE user_id = $user_id";
        //check the query if executed or not
        $cart_res = mysqli_query($conn, $select_cart);
        $cart_count = mysqli_num_rows($cart_res);

        if ($cart_count > 0) {
            while ($cart_row = mysqli_fetch_assoc($cart_res)) {
                $product_id = $cart_row['product_id'];
                $quantity = $cart_row['quantity'];

                //select the stock on tbl_food
                $select_stock = "SELECT product_stock FROM tbl_product WHERE id = $product_id";
                $stock_res = mysqli_query($conn, $select_stock);
                $stock_row = mysqli_fetch_assoc($stock_res); // Assuming one result
                $current_stock = $stock_row['product_stock'];

                $newstock = $current_stock - $quantity;

                $update_stock = "UPDATE tbl_product SET product_stock = $newstock WHERE id = $product_id";
                mysqli_query($conn, $update_stock);
            }


            $sql = "INSERT INTO `tbl_billing`(`user_id`, `name`, `payment_method`, `address`, `total_products`, `total_price`, `place_on`, `payment_amount`, `proof_of_purchase`, `remaining_bal`, `payment_type`, `reference_no`, `order_status`) 
            VALUES ('$user_id','$name','$payment_method','$address','$cart_items','$grandTotal',NOW(),'$payment','$image_name','$remainingbal','$paymentType','$referenceNo','pending')";

            $insert_order_result = mysqli_query($conn, $sql);

            if ($insert_order_result) {
                $delete_cart = "DELETE FROM tbl_cart WHERE user_id = $user_id";
                mysqli_query($conn, $delete_cart);

                echo '<script>
                Swal.fire({
                    icon: "success",
                    text: "Order placed successfully!",
                    timer:1000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "home.php";
                })
         </script>';
                exit;
            } else {
                $error = mysqli_error($conn);
                echo '<script>
                Swal.fire({
                    icon: "error",
                    text: "Failed to place the order. ' . $error . '",
                    timer:1000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "checkout.php";
                })
         </script>';
                exit;
            }
        } else {
            echo '<script>
         swal({
            title: "Error",
            text: "Cart is empty.",
            icon: "error"
         }).then(function() {
            window.location = "checkout.php"; // Redirect to checkout page or appropriate page
         });
      </script>';
            exit;
        }
    }

    ?>
    <script src="js/script.js"></script>
    <script src="js/qrcode.js"></script>

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