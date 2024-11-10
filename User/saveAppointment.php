<?php
include('config/dbcon.php');
session_start();
$services_name = $_POST['services_name'];
$appointment_date = $_POST['appointment_date'];
$appointment_type = $_POST['appointment_type'];
$price = $_POST['total_cost'];

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id']; // Fetch user_id from the session
  
  // Insert into tbl_appointment
  $sql = "INSERT INTO `tbl_appointment`(`user_id`,`services_name`, `appointment_date`,`appointment_type`, `status`, `total_cost`,`created_at`) VALUES ('$user_id','$services_name','$appointment_date','$appointment_type','Pending','$price', CURRENT_TIMESTAMP());";

  if ($conn->query($sql) === TRUE) {
    // Insert into tbl_audit_trail after successful appointment insertion
    $audit_sql = "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`,`activity`, `audit_date`, `audit_time`) VALUES ('user','$user_id','Created an appointment.',CURRENT_DATE(),CURRENT_TIME());";
    
    if ($conn->query($audit_sql) === TRUE) {
      $isSuccess = 1;
      echo json_encode($isSuccess);
    } else {
      echo "Error in audit trail: " . $audit_sql . "<br>" . $conn->error;
    }
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
} else {
  echo json_encode(0);
}
?>
