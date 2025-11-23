<?php
include "config.php";

$name  = $_POST['name'];
$city  = $_POST['city'];
$years = $_POST['years'];

$query = "CALL AddTeam('$name', '$city', '$years')";
mysqli_query($conn, $query);

echo "<script>alert('Team Added Successfully'); window.location.href='teams.html';</script>";
?>
