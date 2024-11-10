<?php
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];

// Check if 'id' key exists in the request
if(isset($_REQUEST['id'])){
    $id = mysqli_real_escape_string($conn, $_REQUEST['id']);

    // Retrieve user details before archiving
    $query_select = "SELECT id, name, email, password, number, address, status, otp_code, email_verified_at FROM tbl_user WHERE id = '$id'";
    $result = mysqli_query($conn, $query_select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Store user details in variables
        $userId = $row['id'];
        $userName = $row['name'];
        $userEmail = $row['email'];
        $userPass = $row['password'];
        $userNumber = $row['number'];
        $userAddress = $row['address'];
        $userStatus = $row['status'];
        $userOtpCode = $row['otp_code'];
        $userVerifiedAt = $row['email_verified_at'];

        // Archive the user
        $query_archive = "INSERT INTO tbl_user_archived (id, name, email, password, number, address, status, otp_code, email_verified_at) VALUES ('$userId', '$userName', '$userEmail', '$userPass', '$userNumber', '$userAddress', 'Inactive/Blocked', '$userOtpCode', '$userVerifiedAt')";
        
        if (mysqli_query($conn, $query_archive)) {
            // Update the status in the main table
            $query_update_status = "UPDATE tbl_user SET status = 'Inactive/Blocked' WHERE id = '$id'";
            $query_delete = "DELETE FROM tbl_user WHERE id = '$id'";
            if (mysqli_query($conn, $query_delete)) {
                // Log the activity in the audit trail
                $activity_details = "ID: $userId, User name: $userName, Email: $userEmail, Number: $userNumber, Address: $userAddress, Status: 'Inactive/Blocked', OTP code: $userOtpCode, Verified At: $userVerifiedAt";
                $query_audit_trail = "INSERT INTO tbl_audit_trail (user_type, user_id, activity, activity_details, audit_date, audit_time) VALUES ('admin', '$user_id', 'The user account has been moved to archive and status is set to be Inactive/Blocked', '$activity_details', CURRENT_DATE(), CURRENT_TIME())";
                
                if (mysqli_query($conn, $query_audit_trail)) {
                    echo "Record deleted and archived successfully";
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error: Archive not found";
        }
    } else {
        echo "Error: User not found";
    }
} else {
    echo "Error: 'id' not provided in the request";
}
?>
