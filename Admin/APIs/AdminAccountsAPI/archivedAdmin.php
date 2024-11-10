<?php
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];

if(isset($_REQUEST['id'])){
    $id = mysqli_real_escape_string($conn, $_REQUEST['id']);

    $query_select = "SELECT id, username, password, email, age, address, image FROM tbl_admin WHERE id = '$id'";
    $result = mysqli_query($conn, $query_select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $adminId = $row['id'];
        $adminUserName = $row['username'];
        $adminPass = $row['password'];
        $adminEmail = $row['email'];
        $adminAge = $row['age'];
        $adminAddress = $row['address'];
        $adminImage = $row['image'];
        
        $query_archive = "INSERT INTO tbl_admin_archived (id, username, password, email, age, address, image) VALUES ('$adminId', '$adminUserName', '$adminPass', '$adminEmail', '$adminAge', '$adminAddress', '$adminImage')";
        
        if (mysqli_query($conn, $query_archive)) {
            
            $query_delete = "DELETE FROM tbl_admin WHERE id = '$id'";
            if (mysqli_query($conn, $query_delete)) {
                
                $activity_details = "ID: $adminId, Admin User name: $adminUserName, Email: $adminEmail, Age: $adminAge,  Address: $adminAddress";
                $query_audit_trail = "INSERT INTO tbl_audit_trail (user_type, user_id, activity, activity_details, audit_date, audit_time) VALUES ('admin', '$user_id', 'The admin account has been move to archive', '$activity_details', CURRENT_DATE(), CURRENT_TIME())";
                
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
        echo "Error: Admin not found";
    }
} else {
    echo "Error: 'id' not provided in the request";
}
?>
