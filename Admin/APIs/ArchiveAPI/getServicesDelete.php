<?php 
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$id = $_POST['id'];

// Fetch product details before deletion
$selectQuery = "SELECT * FROM tbl_services_archived WHERE id = $id";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $serviceName = $row['services_name'];
    $serviceEmail = $row['services_price'];

    // Delete from tbl_product
    $deleteQuery = "DELETE FROM tbl_services_archived WHERE id = $id";

    // Insert into tbl_audit_trail
    $insertQuery = "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES ('admin', '$user_id', 'The service has been deleted', 'ID: $id, Service Name: $serviceName, Price: $servicePrice', CURRENT_DATE(), CURRENT_TIME())";

    if ($conn->query($deleteQuery) === TRUE && $conn->query($insertQuery) === TRUE) {
        echo "Record deleted and audit trail created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: Service not found";
}

$conn->close();
?>
