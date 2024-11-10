<?php
include('../../Config/dbcon.php');
$sql = "SELECT `supplier_id`, `supplier_name` FROM tbl_supplier"; // Replace with your table name and column names
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
