<?php
    include('../../Config/dbcon.php');
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $sql = "CALL spGetSalesReport($startDate,$endDate)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['Total'] = number_format($row['Total'], 2);
            $data[] = $row;
        }
    }

    echo json_encode($data);
?>