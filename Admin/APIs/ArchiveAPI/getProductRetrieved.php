<?php
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$id = $_REQUEST['id'];

// Retrieve product details before archiving
$query_select = "SELECT id, product_name, product_price, image, product_category, product_stock FROM tbl_archived WHERE id = '$id'";
$result = mysqli_query($conn, $query_select);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Store product details in variables
    $prodId = $row['id'];
    $prodName = $row['product_name'];
    $prodPrice = $row['product_price'];
    $prodImage = $row['image'];
    $prodCategory = $row['product_category'];
    $prodStock = $row['product_stock'];

    // Archive the product
    $query_archive = "INSERT INTO tbl_product (id, product_name, product_price, image, product_category, product_stock) VALUES ('$prodId', '$prodName', '$prodPrice', '$prodImage', '$prodCategory', '$prodStock')";
    
    if (mysqli_query($conn, $query_archive)) {
        // Delete the product from the main table
        $query_delete = "DELETE FROM tbl_archived WHERE id = '$id'";
        if (mysqli_query($conn, $query_delete)) {
            // Log the activity in the audit trail
            $activity_details = "ID: $prodId, Product Name: $prodName, Price: $prodPrice, Image: $prodImage, Category: $prodCategory, Stock: $prodStock";
            $query_audit_trail = "INSERT INTO tbl_audit_trail (user_type, user_id, activity, activity_details, audit_date, audit_time) VALUES ('admin', '$user_id', 'The product has been retrieved', '$activity_details', CURRENT_DATE(), CURRENT_TIME())";
            
            if (mysqli_query($conn, $query_audit_trail)) {
                echo "Record deleted and retrieved successfully";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: Archive not found";
    }
} else {
    echo "Error: Product not found";
}
?>
