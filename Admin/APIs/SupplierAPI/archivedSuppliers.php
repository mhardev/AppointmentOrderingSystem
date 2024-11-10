<?php
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$supplierId = $_REQUEST['supplier_id'];

$query_select = "SELECT supplier_id, supplier_name, supplier_address, contact_no, contact_person FROM tbl_supplier WHERE supplier_id = '$supplierId'";
$result = mysqli_query($conn, $query_select);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $supplierId = $row['supplier_id'];
    $supplierName = $row['supplier_name'];
    $supplierAddress = $row['supplier_address'];
    $supplierNumber = $row['contact_no'];
    $supplierPerson = $row['contact_person'];

    $query_archive = "INSERT INTO tbl_supplier_archived (supplier_id, supplier_name, supplier_address, contact_no, contact_person) VALUES ('$supplierId', '$supplierName', '$supplierAddress', '$supplierNumber', '$supplierPerson')";
    
    if (mysqli_query($conn, $query_archive)) {
        
        $query_delete = "DELETE FROM tbl_supplier WHERE supplier_id = '$supplierId'";
        if (mysqli_query($conn, $query_delete)) {
            
            $activity_details = "ID: $supplierId, Supplier name: $supplierName, Address: $supplierAddress, Contact number: $supplierNumber, Supplier Person: $supplierPerson";
            $query_audit_trail = "INSERT INTO tbl_audit_trail (user_type, user_id, activity, activity_details, audit_date, audit_time) VALUES ('admin', '$user_id', 'The supplier has been moved to archive', '$activity_details', CURRENT_DATE(), CURRENT_TIME())";
            
            if (mysqli_query($conn, $query_audit_trail)) {
                echo "Record deleted and archived successfully";
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
    echo "Error: Supplier not found";
}
?>
