<?php
include('../../Config/dbcon.php');
session_start();

// Check if 'name' and 'price' are set in the POST request
if (isset($_POST['supplier_name']) && isset($_POST['supplier_address']) && isset($_POST['contact_no']) && isset($_POST['contact_person'])) {
    $user_id = $_SESSION['admin_id'];
    $supplierName = $_POST['supplier_name'];
    $supplierAddress = $_POST['supplier_address'];
    $supplierNumber = $_POST['contact_no'];
    $supplierPerson = $_POST['contact_person'];

    $sql = "INSERT INTO `tbl_supplier`(`supplier_name`, `supplier_address`, `contact_no`, `contact_person`)  VALUES ('$supplierName','$supplierAddress','$supplierNumber','$supplierPerson');";
    if ($conn->query($sql) === TRUE) {
        $last_inserted_id = $conn->insert_id; // Get the ID of the last inserted service
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Insert audit trail
    $activity_details = "ID: $last_inserted_id, Supplier name: $supplierName, Address: $supplierAddress, Contact number: $supplierNumber, Supplier Person: $supplierPerson";
    $audit_sql = "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES ('admin','$user_id','Added new supplier.', '$activity_details', CURRENT_DATE(),CURRENT_TIME())";

    if ($conn->query($audit_sql) !== TRUE) {
        echo "Error: " . $audit_sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Error: 'supplier name' or 'supplier address' or 'contact number' or 'contact person' not set in the POST request.";
}
?>
