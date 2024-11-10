<?php
include('../../Config/dbcon.php');
session_start();
$user_id = $_SESSION['admin_id'];
$id = $_REQUEST['id'];

$query_select = "SELECT id, services_name, services_price FROM tbl_services WHERE id = '$id'";
$result = mysqli_query($conn, $query_select);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $serviceId = $row['id'];
    $serviceName = $row['services_name'];
    $servicePrice = $row['services_price'];

    $query_archive = "INSERT INTO tbl_services_archived (id, services_name, services_price) VALUES ('$serviceId', '$serviceName', '$servicePrice')";
    
    if (mysqli_query($conn, $query_archive)) {
        
        $query_delete = "DELETE FROM tbl_services WHERE id = '$id'";
        if (mysqli_query($conn, $query_delete)) {
            
            $activity_details = "ID: $serviceId, Service name: $serviceName, Price: $servicePrice";
            $query_audit_trail = "INSERT INTO tbl_audit_trail (user_type, user_id, activity, activity_details, audit_date, audit_time) VALUES ('admin', '$user_id', 'The service has been moved to archive', '$activity_details', CURRENT_DATE(), CURRENT_TIME())";
            
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
    echo "Error: Service not found";
}
?>
