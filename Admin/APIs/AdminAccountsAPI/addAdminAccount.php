<?php
include('../../Config/dbcon.php');
session_start();

if (isset($_POST['user']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['age']) && isset($_POST['Number']) && isset($_POST['address']) && isset($_FILES['file']['name'])) {
    $user_id = $_SESSION['admin_id'];
    $user = $_POST['user'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $age = $_POST['age'];
    $Number = $_POST['Number'];
    $address = $_POST['address'];

    $filename = $_FILES['file']['name'];
    $fileDir = '../../Root/img/admin/' . $filename;
    move_uploaded_file($_FILES['file']['tmp_name'],$fileDir);

    $sql = "INSERT INTO `tbl_admin`(`username`, `password`, `email`, `number`, `age`, `address`, `image`) VALUES ('$user','$pass','$email','$Number','$age','$address','$filename ');";
    if ($conn->query($sql) === TRUE) {
        $last_inserted_id = $conn->insert_id; // Get the ID of the last inserted service
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Insert audit trail
    $activity_details = "ID: $last_inserted_id, Username: $user, Email: $email, Number: $Number, Age: $age, Address: $address, Image: $filename";
    $audit_sql = "INSERT INTO `tbl_audit_trail`( `user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES ('admin','$user_id','Registered a new admin account', '$activity_details', CURRENT_DATE(),CURRENT_TIME())";

    if ($conn->query($audit_sql) !== TRUE) {
        echo "Error: " . $audit_sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Error: 'username' or 'email' or 'password' or 'age' or 'number' or 'address' not set in the POST request.";
}
?>
