<?php
include "config.php";

$teamID = $_GET['teamID'];

$q = "SELECT t.TeamName, SUM(p.Runs) AS TotalRuns
      FROM Player p
      JOIN Team t ON p.TeamID = t.TeamID
      WHERE t.TeamID = $teamID
      GROUP BY t.TeamName";

$res = mysqli_query($conn, $q);

if (mysqli_num_rows($res) == 0) {
    echo "<p style='color:yellow;'>No team found or no runs data available.</p>";
    exit;
}

$r = mysqli_fetch_assoc($res);

echo "
<table class='data-table'>
<tr><th>Team</th><th>Total Runs</th></tr>
<tr>
    <td>{$r['TeamName']}</td>
    <td>{$r['TotalRuns']}</td>
</tr>
</table>
";
?>
