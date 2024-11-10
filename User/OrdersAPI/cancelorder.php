
<?php include('../config/dbcon.php');

$id = $_POST['id'];
$user_id = $_POST['userid'];

$sql = "UPDATE `tbl_billing` SET `order_status`='Cancelled' WHERE id = '$id';" ;
$sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `audit_date`, `audit_time`) VALUES ('user','$user_id','Ordered Product',CURRENT_DATE(),CURRENT_TIME());";
if ($conn-> multi_query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>