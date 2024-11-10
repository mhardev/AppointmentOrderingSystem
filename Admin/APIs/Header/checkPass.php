<?php 
    include('../../Config/dbcon.php');
    session_start();
    $userId = $_SESSION['admin_id'];
    $inputPassword = md5($_POST['id']);

    $sql = "SELECT password FROM `tbl_admin` WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $storedPassword = $row['password'];
            if ($inputPassword == $storedPassword) {
                echo json_encode('1'); // Passwords match
            } else {
                echo json_encode('0'); // Passwords don't match
            }
        }
    } else {
        echo json_encode('0'); // User not found
    }
?>