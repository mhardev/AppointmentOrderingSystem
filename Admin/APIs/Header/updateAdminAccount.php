
<?php 
include('../../Config/dbcon.php');
session_start();

$id = $_SESSION['admin_id'];
$email = $_POST['email'];
$age = $_POST['age'];
$address = $_POST['address'];
$number = $_POST['number'];

$sql = "UPDATE `tbl_admin` SET `email`='$email',`number`='$number',`age`='$age',`address`='$address' WHERE id  = '$id';" ;
$sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `audit_date`, `audit_time`) VALUES ('admin','$id','Updated account info.',CURRENT_DATE(),CURRENT_TIME());";
if ($conn-> multi_query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>