<?php 
include('../../Config/dbcon.php');

$sql = "DELETE FROM `tbl_appointment` WHERE `status` != 'Complete' AND `appointment_date` = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)" ;
if ($conn-> multi_query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>