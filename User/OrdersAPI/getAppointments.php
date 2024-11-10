<?php include('../config/dbcon.php');
session_start();
$userid = $_SESSION['user_id'];

$sql = "SELECT * FROM `tbl_appointment` WHERE user_id = $userid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['total_cost'] = number_format($row['total_cost'], 2);
        $data[] = $row;
    }
}

echo json_encode($data);
