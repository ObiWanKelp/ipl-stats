<?php
include "config.php";

$name = $_POST['name'];
$role = $_POST['role'];
$team = $_POST['team'];

$query = "CALL AddPlayer('$name', '$role', $team)";
mysqli_query($conn, $query);

echo "<script>alert('Player Added Successfully'); window.location.href='players.html';</script>";
?>
