<?php 
include('../../Config/dbcon.php');
$id = $_POST['id'];

$sql = "SELECT *  FROM  WHERE id = $id ;";
if ($conn-> query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>