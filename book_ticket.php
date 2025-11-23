<?php
include "config.php";

$customer = $_POST['customer'];
$email    = $_POST['email'];
$ticket   = $_POST['ticket'];

$query = "CALL BookTicket('$customer', '$email', $ticket)";
mysqli_query($conn, $query);

echo "<script>alert('Ticket Booked Successfully'); window.location.href='bookings.html';</script>";
?>
