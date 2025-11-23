<?php
include "config.php";

$query = "
SELECT p.PlayerID, p.PlayerName, p.Role,
       t.TeamName,
       p.Runs, p.Wickets
FROM Player p
LEFT JOIN Team t ON p.TeamID = t.TeamID
ORDER BY p.PlayerID ASC;
";

$result = mysqli_query($conn, $query);

echo "
<table class='data-table'>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Role</th>
    <th>Team</th>
    <th>Runs</th>
    <th>Wickets</th>
    <th>Action</th>
</tr>
";

while ($row = mysqli_fetch_assoc($result)) {
    echo "
    <tr>
        <td>{$row['PlayerID']}</td>
        <td>{$row['PlayerName']}</td>
        <td>{$row['Role']}</td>
        <td>{$row['TeamName']}</td>
        <td>{$row['Runs']}</td>
        <td>{$row['Wickets']}</td>

        <td>
            <a href='delete.php?type=player&id={$row['PlayerID']}'
               class='delete-btn'
               onclick=\"return confirm('Delete this player? Their match stats and player points will also be deleted!')\">
               Delete
            </a>
        </td>
    </tr>
    ";
}

echo "</table>";
?>
