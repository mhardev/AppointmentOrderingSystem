<?php
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$supplier_id = $_POST['supplier_id'];


$sql = "DELETE FROM `tbl_supplier` WHERE supplier_id = $supplier_id;";
$sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `audit_date`, `audit_time`) VALUES ('admin','$user_id','Deleted a supplier.',CURRENT_DATE(),CURRENT_TIME());";
if ($conn->multi_query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
