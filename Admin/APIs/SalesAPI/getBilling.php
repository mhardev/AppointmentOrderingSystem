<?php
    include('../../Config/dbcon.php');
    $sql = "SELECT * FROM `tbl_billing`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['total_price'] = number_format($row['total_price'], 2);
            $data[] = $row;
        }
    }

    echo json_encode($data);
?>