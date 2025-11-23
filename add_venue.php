<?php
include "config.php";

$name = $_POST['name'];
$city = $_POST['city'];
$state = $_POST['state'];
$stadium = $_POST['stadium'];
$capacity = $_POST['capacity'];

$query = "CALL AddVenue('$name', '$city', '$state', '$stadium', $capacity)";
mysqli_query($conn, $query);

echo "<script>alert('Venue Added'); window.location.href='venues.html';</script>";
?>
