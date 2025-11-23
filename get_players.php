<?php
include "config.php";

$result = mysqli_query($conn, "SELECT PlayerID, PlayerName, Role, TeamID, Runs, Wickets FROM Player");

echo "<table border='1' cellspacing='0' cellpadding='10'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Role</th>
<th>Team ID</th>
<th>Runs</th>
<th>Wickets</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['PlayerID']}</td>
            <td>{$row['PlayerName']}</td>
            <td>{$row['Role']}</td>
            <td>{$row['TeamID']}</td>
            <td>{$row['Runs']}</td>
            <td>{$row['Wickets']}</td>
          </tr>";
}

echo "</table>";
?>
