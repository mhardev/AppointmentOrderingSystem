<?php 
include('../../Config/dbcon.php');
$supplier_id = $_POST['supplier_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_category = $_POST['product_category'];
$product_stock = $_POST['product_stock'];

$filename = $_FILES['file']['name'];
$fileDir = '../../../Root/img/' . $filename;
move_uploaded_file($_FILES['file']['tmp_name'],$fileDir);

$sql = "INSERT INTO `tbl_supplier_products`(`supplier_id`, `product_name`, `product_price`, `product_image`, `product_category`, `product_stock`) 
VALUES ('$supplier_id','$product_name','$product_price','$image','$product_category','$product_stock');";
$sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `activity`, `audit_date`, `audit_time`) VALUES ('admin','Registered New Supplier',CURRENT_DATE(),CURRENT_TIME());";
if ($conn->multi_query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

