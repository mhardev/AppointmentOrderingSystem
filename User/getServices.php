<?php 
include('config/dbcon.php');

$sql = "SELECT * FROM `tbl_services`"; // rReplace with your table name and column names
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