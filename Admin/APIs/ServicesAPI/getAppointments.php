<?php
include('../../Config/dbcon.php');
$data = array(); // Initialize $data as an empty array

$sql = "SELECT * FROM `tbl_appointment`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['total_cost'] = number_format($row['total_cost'], 2);
        $data[] = $row;
    }
}

echo json_encode($data);
?>
