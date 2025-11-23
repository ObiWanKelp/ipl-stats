<?php
include "config.php";

$teamA = $_POST['teamA'];
$teamB = $_POST['teamB'];
$venue = $_POST['venue'];
$time  = $_POST['time'];

$query = "CALL ScheduleMatch($teamA, $teamB, $venue, '$time')";
mysqli_query($conn, $query);

echo "<script>alert('Match Scheduled'); window.location.href='matches.html';</script>";
?>
