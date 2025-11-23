<?php
include "config.php";

$teamID = $_GET['id'];

$query = "CALL DeleteTeam($teamID)";
mysqli_query($conn, $query);

echo "<script>alert('Team Deleted Successfully'); window.location.href='teams.html';</script>";
?>
