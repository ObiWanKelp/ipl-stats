<?php
include "config.php";

$q = "SELECT MatchID, TeamAID, TeamBID, MatchDateTime
      FROM MatchTbl
      ORDER BY MatchDateTime";

$res = mysqli_query($conn, $q);

echo "<table class='data-table'>
<tr><th>Match ID</th><th>Team A</th><th>Team B</th><th>Date/Time</th></tr>";

while ($r = mysqli_fetch_assoc($res)) {
    echo "<tr>
            <td>{$r['MatchID']}</td>
            <td>{$r['TeamAID']}</td>
            <td>{$r['TeamBID']}</td>
            <td>{$r['MatchDateTime']}</td>
          </tr>";
}

echo "</table>";
?>
