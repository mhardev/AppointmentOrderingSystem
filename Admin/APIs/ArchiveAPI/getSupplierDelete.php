<?php 
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$supplierId = $_POST['supplier_id'];

$selectQuery = "SELECT supplier_id, supplier_name, supplier_address, contact_no, contact_person FROM tbl_supplier_archived WHERE supplier_id = $supplierId";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $supplierName = $row['supplier_name'];
    $supplierAddress = $row['supplier_address'];
    $supplierNumber = $row['contact_no'];
    $supplierPerson = $row['contact_person'];

    $deleteQuery = "DELETE FROM tbl_supplier_archived WHERE supplier_id = $supplierId";

    $insertQuery = "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES ('admin', '$user_id', 'The seupplier has been deleted', 'ID: $supplierId, Supplier name: $supplierName, Address: $supplierAddress, Contact number: $supplierNumber, Supplier Person: $supplierPerson', CURRENT_DATE(), CURRENT_TIME())";

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
