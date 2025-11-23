<?php
include "config.php";

$query = "
SELECT m.MatchID,
       t1.TeamName AS TeamA,
       t2.TeamName AS TeamB,
       v.VenueName,
       m.MatchDateTime
FROM MatchTbl m
JOIN Team t1 ON m.TeamAID = t1.TeamID
JOIN Team t2 ON m.TeamBID = t2.TeamID
JOIN Venue v ON m.VenueID = v.VenueID
ORDER BY m.MatchID ASC;
";

$result = mysqli_query($conn, $query);

echo "
<table class='data-table'>
<tr>
    <th>Match ID</th>
    <th>Team A</th>
    <th>Team B</th>
    <th>Venue</th>
    <th>Date & Time</th>
    <th>Action</th>
</tr>
";

while ($r = mysqli_fetch_assoc($result)) {
    echo "
    <tr>
        <td>{$r['MatchID']}</td>
        <td>{$r['TeamA']}</td>
        <td>{$r['TeamB']}</td>
        <td>{$r['VenueName']}</td>
        <td>{$r['MatchDateTime']}</td>

        <td>
            <a href='delete.php?type=match&id={$r['MatchID']}'
               class='delete-btn'
               onclick=\"return confirm('Delete this match? All tickets, bookings, and related stats will be deleted!')\">
               Delete
            </a>
        </td>
    </tr>
    ";
}

echo "</table>";
?>
