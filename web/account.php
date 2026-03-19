<?php
session_start();
include "db.php";

$name = $_SESSION["user"];

$sql = "SELECT * FROM users WHERE name='$name'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<h2>My Account</h2>

Name: <?php echo $row["name"]; ?><br><br>

Balance: <?php echo $row["balance"]; ?> €<br><br>

Status: <?php echo $row["status"]; ?><br><br>

<a href="recharge.php">Recharge</a><br><br>

<a href="logout.php">Logout</a>
