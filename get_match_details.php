<?php
include "config.php";

$q = "SELECT m.MatchID,
             t1.TeamName AS TeamA,
             t2.TeamName AS TeamB,
             v.VenueName,
             m.MatchDateTime
      FROM MatchTbl m
      JOIN Team t1 ON m.TeamAID = t1.TeamID
      JOIN Team t2 ON m.TeamBID = t2.TeamID
      JOIN Venue v ON m.VenueID = v.VenueID";

$res = mysqli_query($conn, $q);

echo "<table class='data-table'>
<tr><th>ID</th><th>Team A</th><th>Team B</th><th>Venue</th><th>Time</th></tr>";

while ($r = mysqli_fetch_assoc($res)) {
    echo "<tr>
            <td>{$r['MatchID']}</td>
            <td>{$r['TeamA']}</td>
            <td>{$r['TeamB']}</td>
            <td>{$r['VenueName']}</td>
            <td>{$r['MatchDateTime']}</td>
          </tr>";
}

echo "</table>";
?>
