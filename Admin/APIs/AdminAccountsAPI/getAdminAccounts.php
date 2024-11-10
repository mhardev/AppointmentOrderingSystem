<?php
    include('../../Config/dbcon.php');
    $sql = "SELECT * FROM `tbl_admin`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode($data);
?>