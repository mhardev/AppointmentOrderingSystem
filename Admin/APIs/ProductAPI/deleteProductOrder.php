<?php 
include('../../Config/dbcon.php');
$id = $_POST['id'];
$user_id = $_SESSION['admin_id'];

$sql = "DELETE FROM tbl_billing WHERE id = $id;";
$sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `audit_date`, `audit_time`) VALUES ('admin', '$user_id', 'Deleted a product' ,CURRENT_DATE(),CURRENT_TIME());";
if ($conn-> multi_query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>