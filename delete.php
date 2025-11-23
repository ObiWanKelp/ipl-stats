<?php
include "config.php";

if (!isset($_GET['type']) || !isset($_GET['id'])) {
    die("Invalid request.");
}

$type = $_GET['type'];
$id   = intval($_GET['id']);
$redirect = "";

/* ------------------- TYPE HANDLER ------------------- */

switch($type) {

    case "team":
        mysqli_query($conn, "CALL DeleteTeam($id)");
        $redirect = "teams.html";
        break;

    case "player":
        mysqli_query($conn, "CALL DeletePlayer($id)");
        $redirect = "players.html";
        break;

    case "venue":
        mysqli_query($conn, "CALL DeleteVenue($id)");
        $redirect = "venues.html";
        break;

    case "match":
        mysqli_query($conn, "CALL DeleteMatch($id)");
        $redirect = "matches.html";
        break;

    case "ticket":
        mysqli_query($conn, "CALL DeleteTicket($id)");
        $redirect = "tickets.html";
        break;

    case "booking":
        mysqli_query($conn, "CALL DeleteBooking($id)");
        $redirect = "bookings.html";
        break;

    default:
        die("Invalid delete type");
}

echo "<script>alert('Deleted Successfully'); window.location.href='$redirect';</script>";
?>
