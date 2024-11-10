<?php 
    include('../../Config/dbcon.php');
    session_start();
    $user_id = $_SESSION['admin_id'];
    $newPass = md5($_POST['pass']);

    $sql = "UPDATE `tbl_admin` SET `password`= '$newPass' WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode('1'); // Password updated successfully
    } else {
        echo json_encode('0'); // Failed to update password
    }
?>