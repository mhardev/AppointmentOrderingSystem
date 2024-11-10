<?php 
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$id = $_POST['id'];

// Fetch product details before deletion
$selectQuery = "SELECT * FROM tbl_user_archived WHERE id = $id";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row['id'];
    $userName = $row['name'];
    $userEmail = $row['email'];
    $userPass = $row['password'];
    $userNumber = $row['number'];
    $userAddress = $row['address'];
    $userStatus = $row['status'];
    $userOtpCode = $row['otp_code'];
    $userVerifiedAt = $row['email_verified_at'];

    // Delete from tbl_product
    $deleteQuery = "DELETE FROM tbl_user_archived WHERE id = $id";

    // Insert into tbl_audit_trail
    $insertQuery = "INSERT INTO `tbl_audit_trail`(`user_type`, `user_id`, `activity`, `activity_details`, `audit_date`, `audit_time`) VALUES ('admin', '$user_id', 'The user has been deleted', 'ID: $id, User Name: $userName, Email: $userEmail, Number: $userNumber, Address: $userAddress, Status: $userStatus, OTP code: $userOtpCode, Verified At: $userVerifiedAt', CURRENT_DATE(), CURRENT_TIME())";

    if ($conn->query($deleteQuery) === TRUE && $conn->query($insertQuery) === TRUE) {
        echo "Record deleted and audit trail created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Error: User not found";
}

$conn->close();
?>
