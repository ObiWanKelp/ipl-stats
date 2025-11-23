<?php
include "config.php";

$query = "
SELECT b.BookingID, 
       b.CustomerName, 
       b.Email,
       t.Category, 
       t.Price,
       m.MatchDateTime
FROM Booking b
JOIN Ticket t ON b.TicketID = t.TicketID
JOIN MatchTbl m ON t.MatchID = m.MatchID
ORDER BY b.BookingID DESC;
";

$result = mysqli_query($conn, $query);

echo "
<table class='data-table'>
<tr>
    <th>Booking ID</th>
    <th>Customer</th>
    <th>Email</th>
    <th>Category</th>
    <th>Price</th>
    <th>Match Time</th>
    <th>Action</th>
</tr>
";

while ($row = mysqli_fetch_assoc($result)) {

    echo "
    <tr>
        <td>{$row['BookingID']}</td>
        <td>{$row['CustomerName']}</td>
        <td>{$row['Email']}</td>
        <td>{$row['Category']}</td>
        <td>{$row['Price']}</td>
        <td>{$row['MatchDateTime']}</td>

        <td>
            <a href='delete.php?type=booking&id={$row['BookingID']}'
               class='delete-btn'
               onclick=\"return confirm('Delete this booking? This action is permanent.')\">
               Delete
            </a>
        </td>
    </tr>
    ";
}

echo "</table>";
?>
