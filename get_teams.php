<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM Team");

echo "
<table class='data-table'>
<tr>
    <th>Team ID</th>
    <th>Name</th>
    <th>City</th>
    <th>Winning Years</th>
    <th>Action</th>
</tr>
";

while ($row = mysqli_fetch_assoc($result)) {

    echo "
    <tr>
        <td>{$row['TeamID']}</td>
        <td>{$row['TeamName']}</td>
        <td>{$row['City']}</td>
        <td>{$row['WinningYears']}</td>

        <td>
            <a href='delete.php?type=team&id={$row['TeamID']}'
               class='delete-btn'
               onclick=\"return confirm('Delete this team? All players, matches, tickets, and bookings for this team will be deleted!')\">
               Delete
            </a>
        </td>
    </tr>
    ";
}

echo "</table>";
?>
