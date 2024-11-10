<?php
include('../../Config/dbcon.php');

$id = $_POST['id'];
$user_id = $_POST['admin_id'];
$status = $_POST['status'];
$value = '';

switch ($status) {
    case 1:
        $value = "Pending";
        break;
    case 2:
        $value = "Cancelled";
        break;
    case 3:
        $value = "Not Paid"; // Corrected value for case 3
        break;
    case 4:
        $value = "Complete";
        break;
}

$sql = "UPDATE `tbl_appointment` SET `status`='$value' WHERE id = $id;";
$sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `audit_date`, `audit_time`) VALUES ('admin','$user_id','Updated a status of an appointment.',CURRENT_DATE(),CURRENT_TIME());";

if ($conn->multi_query($sql) === TRUE) {
    echo "Status updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
