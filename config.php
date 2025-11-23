<?php
$host = "localhost";
$user = "root"; 
$pass = ""; 
$db   = "ipl_dbms";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
