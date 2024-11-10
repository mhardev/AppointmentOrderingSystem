<?php
    include('../../Config/dbcon.php');
    session_start();
    session_unset();
    session_destroy();

    header('location: ../adminlogin.php');
?>