<?php
include('../../Config/dbcon.php');

session_start();
$user_id = $_SESSION['admin_id'];
$id = $_POST['id'];
$product_name = $_POST['product_name'];
$product_stock = $_POST['product_stock'];

$getSuppStock = "SELECT SP.product_stock AS supplierStock, P.product_stock AS productStock
FROM tbl_supplier_products SP
LEFT JOIN tbl_product P ON P.product_name = SP.product_name
WHERE SP.product_name = '$product_name'";
$result = $conn->query($getSuppStock);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stock = $row['supplierStock'];
        $prdStock = $row['productStock'];
    }
} else {
    $stock = 0;
}

if ($product_stock <= $stock) {
    $stock -= $product_stock;
    $prdStock += $product_stock;
    $sql = "UPDATE `tbl_product` SET `product_stock`= $prdStock WHERE `id` = $id;";
    $sql .= "UPDATE `tbl_supplier_products` SET `product_stock`= $stock WHERE `product_name` = '$product_name';";
    $sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `audit_date`, `audit_time`) VALUES ('admin','$user_id','Updated a product stock.',CURRENT_DATE(),CURRENT_TIME());";
    if ($conn->multi_query($sql) === TRUE) {
        echo "New record created successfully";
        $data = 1;
        echo json_encode($data);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} 

if($product_stock > $stock) {
    $data = 0;
    echo json_encode($data);
}
