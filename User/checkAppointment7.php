<?php 
    include('config/dbcon.php');

    $date = $_GET['date']; 

    $sql = "SELECT COUNT(*) as appointments FROM `tbl_appointment` WHERE TIME(appointment_date) BETWEEN '15:00:00' AND '16:00:00' AND DATE(appointment_date) = '$date'"; // rReplace with your table name and column names
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }else{
        $data = null;
    }
    echo json_encode($data);
?>