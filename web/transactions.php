<?php
include "db.php";

$result = $conn->query("SELECT * FROM transactions");

echo "<h2>Transactions</h2>";

echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Amount</th>
        <th>Type</th>
        <th>Date</th>
      </tr>";

while($row = $result->fetch_assoc()){

    echo "<tr>";

    echo "<td>".$row["id"]."</td>";
    echo "<td>".$row["user_id"]."</td>";
    echo "<td>".$row["amount"]."</td>";
    echo "<td>".$row["type"]."</td>";
    echo "<td>".$row["created_at"]."</td>";

    echo "</tr>";
}

echo "</table>";

?>

<br>
<a href="index.php">Back</a>

