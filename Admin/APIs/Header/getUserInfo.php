<?php
    include('../../Config/dbcon.php');
    session_start();
    $id = $_SESSION['admin_id'];
    $sql = "SELECT * FROM `tbl_admin` WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
?>