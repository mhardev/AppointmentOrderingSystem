<?php 
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$id = $_POST['id'];

$selectQuery = "SELECT * FROM tbl_admin_archived WHERE id = $id";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $adminId = $row['id'];
    $adminUserName = $row['username'];
    $adminPass = $row['password'];
    $adminEmail = $row['email'];
    $adminAge = $row['age'];
    $adminAddress = $row['address'];
    $adminImage = $row['image'];

    $deleteQuery = "DELETE FROM tbl_admin_archived WHERE id = $id";

    $insertQuery = "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES ('admin', '$user_id', 'The user has been deleted', 'ID: $adminId, Admin User name: $adminUserName, Email: $adminEmail, Age: $adminAge,  Address: $adminAddress', CURRENT_DATE(), CURRENT_TIME())";

    if ($conn->query($deleteQuery) === TRUE && $conn->query($insertQuery) === TRUE) {
        echo "Record deleted and audit trail created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: Admin not found";
}

$conn->close();
?>
