<?php
include "db.php";

$result = $conn->query("SELECT * FROM users");

echo "<h2>User Management</h2>";

echo "<table border='1'>";
echo "<tr>
<th>ID</th>
<th>Name</th>
<th>Status</th>
<th>Action</th>
</tr>";

while($row = $result->fetch_assoc()){

$id = $row["id"];
$status = $row["status"];

echo "<tr>";
echo "<td>".$row["id"]."</td>";
echo "<td>".$row["name"]."</td>";
echo "<td>".$status."</td>";

if($status=="active"){

echo "<td><a href='disable.php?id=$id'>Disable</a></td>";

}else{

echo "<td><a href='enable.php?id=$id'>Enable</a></td>";

}

echo "</tr>";

}

echo "</table>";
?>

<a href="dashboard.php">Back</a>
