
<?php
include('../../Config/dbcon.php');
session_start();

$user_id = $_SESSION['admin_id'];
$filename = $_FILES['file']['name'];
$fileDir = '../../Root/img/admin/' . $filename;
move_uploaded_file($_FILES['file']['tmp_name'], $fileDir);

$sql = "UPDATE `tbl_admin` SET `image`='$filename' WHERE id = $user_id;";
$sql .= "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `audit_date`, `audit_time`) VALUES ('admin',$user_id,'Updete profile pic.',CURRENT_DATE(),CURRENT_TIME())";
if ($conn->multi_query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>