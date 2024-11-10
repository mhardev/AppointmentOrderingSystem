<?php
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$supplier_id = $_POST['supplier_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_category = $_POST['product_category'];
$product_stock = $_POST['product_stock'];

$filename = $_FILES['file']['name'];
$fileDir = '../../../Root/img/product/' . $filename;
$fileDir1 = '../../Root/img/product/' . $filename;
$fileDir2 = '../../../User/images/product/' . $filename;

// Move the uploaded file to the first directory
if (move_uploaded_file($_FILES['file']['tmp_name'], $fileDir)) {
    // Copy the file to the other directories
    copy($fileDir, $fileDir1);
    copy($fileDir, $fileDir2);
} else {
    echo '<script>
              swal({
                  title: "Error",
                  text: "Failed to upload image",
                  icon: "error"
              }).then(function() {
                  window.location = "addsupplierproducts.php";
              });
          </script>';
}

$checkProduct = "SELECT * FROM `tbl_supplier_products` WHERE `product_name` = '$product_name' AND supplier_id = $supplier_id";
$result = $conn->query($checkProduct);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newStock = $product_stock + $row['product_stock'];

        // Update product stock and log the activity
        $sql = "UPDATE `tbl_supplier_products` SET `product_stock`= $newStock WHERE `supplier_id` = $supplier_id AND `product_name` = '$product_name';";
        $sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) 
                 VALUES ('admin','$user_id','Updated supplier product', 
                 'Product Name: $product_name, Price: $product_price, Image: $filename, Category: $product_category, New Stock: $newStock', 
                 CURRENT_DATE(), CURRENT_TIME());";

        if ($conn->multi_query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    // Insert new product and log the activity
    $sql = "INSERT INTO `tbl_supplier_products`(`supplier_id`, `product_name`, `product_price`, `product_image`, `product_category`, `product_stock`) 
            VALUES ('$supplier_id','$product_name','$product_price','$filename','$product_category','$product_stock');";
    $sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) 
             VALUES ('admin','$user_id','Add supplier product', 
             'Product Name: $product_name, Price: $product_price, Image: $filename, Category: $product_category, Stock: $product_stock', 
             CURRENT_DATE(), CURRENT_TIME());";

    if ($conn->multi_query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
