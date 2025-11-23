<?php
include "config.php";

$query = "
SELECT t.TeamName,
       tp.MatchesPlayed,
       tp.Wins,
       tp.Losses,
       tp.Points
FROM TeamPoints tp
JOIN Team t ON tp.TeamID = t.TeamID
ORDER BY tp.Points DESC;
";

$result = mysqli_query($conn, $query);

echo "
<table class='data-table'>
<tr>
    <th>Team</th>
    <th>Matches</th>
    <th>Wins</th>
    <th>Losses</th>
    <th>Points</th>
</tr>
";

while ($r = mysqli_fetch_assoc($result)) {
    echo "
    <tr>
        <td>{$r['TeamName']}</td>
        <td>{$r['MatchesPlayed']}</td>
        <td>{$r['Wins']}</td>
        <td>{$r['Losses']}</td>
        <td>{$r['Points']}</td>
    </tr>
    ";
}

echo "</table>";
?>
