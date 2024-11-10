<?php 
include('../../Config/dbcon.php');

$sql = "SELECT SP.tbl_id, SP.supplier_id, S.supplier_name, SP.product_price, SP.product_image, SP.product_category, SP.product_stock 
        FROM `tbl_supplier_products` SP
        LEFT JOIN tbl_supplier S ON SP.supplier_id = S.supplier_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['product_price'] = number_format($row['product_price'], 2);
        $data[] = $row;
    }
}

echo json_encode($data);
?>
