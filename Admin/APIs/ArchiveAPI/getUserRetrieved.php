<?php
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];

// Check if 'id' is set in the request
if (isset($_REQUEST['id'])) {
    $id = mysqli_real_escape_string($conn, $_REQUEST['id']);

    // Retrieve user details before archiving
    $query_select = "SELECT id, name, email, password, number, address, status, otp_code, email_verified_at FROM tbl_user_archived WHERE id = '$id'";
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

        // Retrieve the user to the main table
        $query_retrieve = "INSERT INTO tbl_user (id, name, email, password, number, address, status, otp_code, email_verified_at) VALUES ('$userId', '$userName', '$userEmail', '$userPass', '$userNumber', '$userAddress', 'Active', '$userOtpCode', '$userVerifiedAt')";

        if (mysqli_query($conn, $query_retrieve)) {
            // Update the user status in the archived table
            $query_update_status = "UPDATE tbl_user_archived SET status = '$userStatus' WHERE id = '$id'";
            $query_delete = "DELETE FROM tbl_user_archived WHERE id = '$id'";
            if (mysqli_query($conn, $query_delete)) {
                // Log the activity in the audit trail
                $activity_details = "ID: $userId, User name: $userName, Email: $userEmail, Number: $userNumber, Address: $userAddress, Status: 'Active', OTP code: $userOtpCode, Verified At: $userVerifiedAt";
                $query_audit_trail = "INSERT INTO tbl_audit_trail (user_type, user_id, activity, activity_details, audit_date, audit_time) VALUES ('admin', '$user_id', 'The user account has been retrieved and status is set to be Active', '$activity_details', CURRENT_DATE(), CURRENT_TIME())";

                if (mysqli_query($conn, $query_audit_trail)) {
                    echo "Record retrieved successfully";
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error: Unable to retrieve the record";
        }
    } else {
        echo "Error: User not found in the archive";
    }
} else {
    echo "Error: 'id' is not set in the request";
}
?>
