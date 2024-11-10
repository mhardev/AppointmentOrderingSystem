<?php

$server = "154.56.38.42";
$username = "u572443248_motojen";
$password = "Motojen_123";
$dbname = "u572443248_motojen_db";

// Create connection
$conn = mysqli_connect($server, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully";
?>


