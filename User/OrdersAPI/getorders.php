<?php include('../config/dbcon.php');

$id = $_GET['id']; 

$sql = "SELECT * FROM `tbl_billing` WHERE `user_id` = $id"; // rReplace with your table name and column names
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['total_price'] = number_format($row['total_price'], 2);
        $data[] = $row;
    }
}else{
    $data = null;
}

echo json_encode($data);
?>