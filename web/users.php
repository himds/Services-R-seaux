<?php
include "db.php";

$result = $conn->query("SELECT * FROM users");

echo "<h2>User List</h2>";

echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>RFID</th>
        <th>Balance</th>
        <th>Status</th>
      </tr>";

while($row = $result->fetch_assoc()){

    echo "<tr>";

    echo "<td>".$row["id"]."</td>";
    echo "<td>".$row["name"]."</td>";
    echo "<td>".$row["rfid_uid"]."</td>";
    echo "<td>".$row["balance"]."</td>";
    echo "<td>".$row["status"]."</td>";

    echo "</tr>";
}

echo "</table>";

?>

<br>
<a href="dashboard.php">Back</a>
