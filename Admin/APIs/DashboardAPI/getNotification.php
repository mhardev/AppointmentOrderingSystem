<?php
include('../../Config/dbcon.php');
session_start();
$sql = "SELECT * FROM `notifications`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = null;
}
echo json_encode($data);
