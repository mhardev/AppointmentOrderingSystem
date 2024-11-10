<?php
include('config/dbcon.php');

$date = $_GET['date'];

$sql = "CALL spGetAppSlots('$date')"; // rReplace with your table name and column names
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = '';
}
echo json_encode($data);
