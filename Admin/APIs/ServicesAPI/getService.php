<?php
    include('../../Config/dbcon.php');
    $id = $_GET['id'];
    $sql = "SELECT services_name,services_price FROM `tbl_services` WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['services_price'] = number_format($row['services_price'], 2);
            $data[] = $row;
        }
    }

    echo json_encode($data);
?>