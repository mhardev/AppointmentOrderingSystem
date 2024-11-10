<?php 
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$id = $_POST['tbl_id'];

// Fetch product details before deletion
$selectQuery = "SELECT SP.tbl_id, SP.supplier_id, SP.product_name, SP.product_price, SP.product_image, SP.product_category, SP.product_stock, S.supplier_name 
    FROM tbl_supplier_products_archived SP
    LEFT JOIN tbl_supplier S ON SP.supplier_id = S.supplier_id
    WHERE SP.tbl_id = '$id'";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $tblId = $row['tbl_id'];
    $suppId = $row['supplier_id'];
    $suppName = $row['supplier_name'];
    $prodName = $row['product_name'];
    $prodPrice = $row['product_price'];
    $prodImage = $row['product_image'];
    $prodCategory = $row['product_category'];
    $prodStock = $row['product_stock'];

    // Delete from tbl_product
    $deleteQuery = "DELETE FROM tbl_supplier_products_archived WHERE tbl_id = $id";

    // Insert into tbl_audit_trail
    $insertQuery = "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES ('admin', '$user_id', 'The user has been deleted', 'ID: $tblId, Supplier ID: $suppId, Supplier Name: $suppName, Product Name: $prodName, Price: $prodPrice, Image: $prodImage, Category: $prodCategory, Stock: $prodStock', CURRENT_DATE(), CURRENT_TIME())";

    if ($conn->query($deleteQuery) === TRUE && $conn->query($insertQuery) === TRUE) {
        echo "Record deleted and audit trail created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: User not found";
}

$conn->close();
?>
