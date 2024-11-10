<?php
include('../../Config/dbcon.php');
$sql = "SELECT * FROM `tbl_services_archived`";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['services_price'] = number_format($row['services_price'], 2);
        $data[] = $row;
    }
}

echo json_encode($data);
?>