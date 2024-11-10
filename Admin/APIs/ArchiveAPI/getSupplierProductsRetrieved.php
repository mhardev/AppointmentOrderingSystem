<?php
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$id = $_REQUEST['tbl_id']; // Change 'id' to 'tbl_id'

// Retrieve product details before archiving
$query_select = "SELECT SP.tbl_id, SP.supplier_id, SP.product_name, SP.product_price, SP.product_image, SP.product_category, SP.product_stock, S.supplier_name 
                FROM tbl_supplier_products_archived SP
                LEFT JOIN tbl_supplier S ON SP.supplier_id = S.supplier_id
                WHERE SP.tbl_id = '$id'"; // Add the join with tbl_supplier
$result = mysqli_query($conn, $query_select);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Store product details in variables
    $tblId = $row['tbl_id'];
    $suppId = $row['supplier_id'];
    $suppName = $row['supplier_name'];
    $prodName = $row['product_name'];
    $prodPrice = $row['product_price'];
    $prodImage = $row['product_image'];
    $prodCategory = $row['product_category'];
    $prodStock = $row['product_stock'];

    // Archive the product
    $query_archive = "INSERT INTO tbl_supplier_products (supplier_id, product_name, product_price, product_image, product_category, product_stock) 
                     VALUES ('$suppId', '$prodName', '$prodPrice', '$prodImage', '$prodCategory', '$prodStock')";
    
    if (mysqli_query($conn, $query_archive)) {
        // Delete the product from the main table
        $query_delete = "DELETE FROM tbl_supplier_products_archived WHERE tbl_id = '$tblId'";
        if (mysqli_query($conn, $query_delete)) {
            // Log the activity in the audit trail
            $activity_details = "ID: $tblId, Supplier ID: $suppId, Supplier Name: $suppName, Product Name: $prodName, Price: $prodPrice, Image: $prodImage, Category: $prodCategory, Stock: $prodStock";
            $query_audit_trail = "INSERT INTO tbl_audit_trail (user_type, user_id, activity, activity_details, audit_date, audit_time) 
                                  VALUES ('admin', '$user_id', 'Product has been moved to retrieved', '$activity_details', CURRENT_DATE(), CURRENT_TIME())";
            
            if (mysqli_query($conn, $query_audit_trail)) {
                echo "Record deleted and retrieved successfully";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: Retrieved not found";
    }
} else {
    echo "Error: Product not found";
}
?>
