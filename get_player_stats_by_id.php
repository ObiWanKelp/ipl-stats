<?php
include "config.php";

$playerID = $_GET['playerID'];

$q = "SELECT 
        p.PlayerName,
        p.Role,
        p.Runs,
        p.Wickets,
        p.MatchesPlayed
      FROM Player p
      WHERE p.PlayerID = $playerID";

$res = mysqli_query($conn, $q);

if (mysqli_num_rows($res) == 0) {
    echo "<p style='color:yellow;'>No player found with this ID.</p>";
    exit;
}

$r = mysqli_fetch_assoc($res);

echo "
<table class='data-table'>
<tr><th>Player</th><th>Role</th><th>Total Runs</th><th>Wickets</th><th>Matches</th></tr>
<tr>
    <td>{$r['PlayerName']}</td>
    <td>{$r['Role']}</td>
    <td>{$r['Runs']}</td>
    <td>{$r['Wickets']}</td>
    <td>{$r['MatchesPlayed']}</td>
</tr>
</table>
";
?>
