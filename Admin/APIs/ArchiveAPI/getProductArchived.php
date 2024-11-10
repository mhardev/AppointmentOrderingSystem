<?php
include('../../Config/dbcon.php');
$sql = "SELECT * FROM `tbl_archived`";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['product_price'] = number_format($row['product_price'], 2);
        $data[] = $row;
    }
}

echo json_encode($data);
?>