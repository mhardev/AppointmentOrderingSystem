<?php
include('../../Config/dbcon.php');
$id = $_GET['id'];
$sql = "SELECT `product_name` FROM `tbl_supplier_products` WHERE `supplier_id` = $id"; // Replace with your table name and column names
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
