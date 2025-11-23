<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM Venue");

echo "
<table class='data-table'>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>City</th>
    <th>State</th>
    <th>Stadium</th>
    <th>Capacity</th>
    <th>Action</th>
</tr>
";

while ($r = mysqli_fetch_assoc($result)) {
    echo "
    <tr>
        <td>{$r['VenueID']}</td>
        <td>{$r['VenueName']}</td>
        <td>{$r['City']}</td>
        <td>{$r['StateName']}</td>
        <td>{$r['StadiumName']}</td>
        <td>{$r['SeatingCapacity']}</td>

        <td>
            <a href='delete.php?type=venue&id={$r['VenueID']}'
               class='delete-btn'
               onclick=\"return confirm('Delete this venue? All matches and bookings connected to this venue will also be deleted!')\">
               Delete
            </a>
        </td>
    </tr>
    ";
}

echo "</table>";
?>
