<?php
include('config/dbcon.php');

$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$number = $_POST['number'];
$pass = $_POST['pass'];

$hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

$sql = "INSERT INTO tbl_user (`name`, `email`, `password`, `number`, `address`) VALUES ('$name', '$email', '$hashedPassword', '$number', '$address')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
