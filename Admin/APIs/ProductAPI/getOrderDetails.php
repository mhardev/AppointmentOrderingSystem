<?php 
include('../../Config/dbcon.php');
$id = $_GET['id'];

$sql = "SELECT `total_products`, `total_price` FROM `tbl_billing` WHERE id = $id"; // rReplace with your table name and column names
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['total_price'] = number_format($row['total_price'], 2);
        $data[] = $row;
    }
}

echo json_encode($data);
?>