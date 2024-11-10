<?php 
include('../../Config/dbcon.php');
$id = $_POST['id'];
$user_id = $_POST['admin_id'];
$status = $_POST['status']; // Update this line to match the key sent from JavaScript
$value = '';

switch($status){
    case 1:
        $value = "Cancelled";
        break;
    case 2:
        $value = "For Pickup";
        break;
    case 3:
        $value = "Complete";
        break;
}

$sql = "UPDATE `tbl_billing` SET `order_status`='$value' WHERE id = '$id';";
$sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `audit_date`, `audit_time`) VALUES ('admin','$user_id','Updated a status of an order.',CURRENT_DATE(),CURRENT_TIME());";

if ($conn->multi_query($sql) === TRUE) {
    echo "Status Updated Successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
