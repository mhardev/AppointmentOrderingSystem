<?php
include('../../Config/dbcon.php');
$name = $_GET['name'];
$sql = "SELECT `tbl_id`, `product_price`, `product_image`, `product_category`, `product_stock` FROM `tbl_supplier_products` WHERE `product_name` = '$name'"; // Replace with your table name and column names
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['product_price'] = number_format($row['product_price'], 2);
        $data[] = $row;
    }
}

echo json_encode($data);
