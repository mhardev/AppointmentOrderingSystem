<?php
include('../../Config/dbcon.php');
$sql = "SELECT * FROM `tbl_audit_trail` ORDER BY audit_date DESC";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = null;
}

echo json_encode($data);
