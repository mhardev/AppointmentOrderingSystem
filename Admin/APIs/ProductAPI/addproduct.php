<?php
include('../../Config/dbcon.php');
session_start();
$avail_stock = $_POST['available_stock'];
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$image = $_POST['image'];
$product_category = $_POST['product_category'];
$stock_ordered = $_POST['product_stock'];

$stockLeft = $avail_stock - $stock_ordered;

$user_id = $_SESSION['admin_id'];



$sql = "INSERT INTO tbl_product(`product_name`, `product_price`, `image`, `product_category`, `product_stock`) 
        VALUES ('$product_name','$product_price','$image','$product_category','$stock_ordered');";
$sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES ('admin','$user_id','Ordered Product', 'ID: $product_id, Product Name: $prodName, Price: $prodPrice, Image: $prodImage, Category: $prodCategory, Stock: $prodStock', CURRENT_DATE(), CURRENT_TIME())";
$sql .= "UPDATE `tbl_supplier_products` SET `product_stock`= '$stockLeft' WHERE `tbl_id` = '$product_id';";
if ($conn-> multi_query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
