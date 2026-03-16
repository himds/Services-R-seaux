<?php

session_start();

if(!isset($_SESSION["admin"])){

    header("Location: login.php");
    exit();

}

?>

<h2>Admin Dashboard</h2>

<a href="create_user.php">Create User</a><br><br>

<a href="users.php">View Users</a><br><br>

<a href="transactions.php">View Transactions</a><br><br>

<a href="logout.php">Logout</a>
