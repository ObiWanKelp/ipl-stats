<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM Team");

echo "<table border='1' cellspacing='0' cellpadding='10'>
<tr>
<th>Team ID</th>
<th>Name</th>
<th>City</th>
<th>Winning Years</th>
<th>Action</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['TeamID']}</td>
            <td>{$row['TeamName']}</td>
            <td>{$row['City']}</td>
            <td>{$row['WinningYears']}</td>
            <td>
                <a href='delete_team.php?id={$row['TeamID']}' 
                   onclick=\"return confirm('Delete this team?')\">
                   Delete
                </a>
            </td>
          </tr>";
}


echo "</table>";
?>
