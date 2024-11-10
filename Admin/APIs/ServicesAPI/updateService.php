<?php
include('../../Config/dbcon.php');
session_start();

$user_id = $_SESSION['user_id'];
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];

$sql = "UPDATE `tbl_services` SET `services_name`='$name', `services_price`='$price' WHERE id = $id;";

if ($conn->query($sql) === TRUE) {
    // Update successful, now add audit trail
    $audit_sql = "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `audit_date`, `audit_time`) VALUES ('admin', $user_id, 'Updated a service.', CURRENT_DATE(), CURRENT_TIME());";

    if ($conn->query($audit_sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error in audit trail: " . $audit_sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
