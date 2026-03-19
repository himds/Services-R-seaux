<?php
include "db.php";

$id = $_GET["id"];

$conn->query("UPDATE users SET status='disabled' WHERE id=$id");

header("Location: manage_users.php");
?>
