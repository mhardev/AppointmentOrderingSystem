<?php 
include('../../Config/dbcon.php');

$sql = "SELECT * FROM `tbl_billing` ORDER BY place_on DESC"; // rReplace with your table name and column names
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['total_price'] = number_format($row['total_price'], 2);
        $data[] = $row;
    }
}

echo json_encode($data);
?>