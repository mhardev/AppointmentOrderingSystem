<?php 
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$id = $_POST['id'];
$prodName = '';

// Fetch product details before deletion
$selectQuery = "SELECT * FROM tbl_product WHERE id = $id";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $prodName = $row['product_name'];
    $prodCategory = $row['product_category'];
    $prodImage = $row['product_image'];
    $prodStock = $row['product_stock'];
    $prodPrice = $row['product_price'];

    // Delete from tbl_product
    $deleteQuery = "DELETE FROM tbl_archived WHERE id = $id";

    // Insert into tbl_audit_trail
    $insertQuery = "INSERT INTO `tbl_audit_trail`(`user_type`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES ('admin', 'Deleted a product', 'ID: $id, Product Name: $prodName, Price: $prodPrice, Image: $prodImage, Category: $prodCategory, Stock: $prodStock', CURRENT_DATE(), CURRENT_TIME())";

    if ($conn->query($deleteQuery) === TRUE && $conn->query($insertQuery) === TRUE) {
        echo "Record deleted and audit trail created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: Product not found";
}

$conn->close();
?>
