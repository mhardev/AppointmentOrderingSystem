<?php
include('../../Config/dbcon.php');
session_start();

// Check if 'name' and 'price' are set in the POST request
if (isset($_POST['name']) && isset($_POST['price'])) {
    $user_id = $_SESSION['admin_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Insert service
    $sql = "INSERT INTO `tbl_services`(`services_name`, `services_price`) VALUES ('$name','$price')";
    if ($conn->query($sql) === TRUE) {
        $last_inserted_id = $conn->insert_id; // Get the ID of the last inserted service
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Insert audit trail
    $activity_details = "ID: $last_inserted_id, Services Name: $name, Price: $price";
    $audit_sql = "INSERT INTO `tbl_audit_trail`( `user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES ('admin','$user_id','Added a service.', '$activity_details', CURRENT_DATE(),CURRENT_TIME())";

    if ($conn->query($audit_sql) !== TRUE) {
        echo "Error: " . $audit_sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Error: 'name' or 'price' not set in the POST request.";
}
?>
