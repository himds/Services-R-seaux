<?php

session_start();

if(!isset($_SESSION["admin"])){

    header("Location: login.php");
    exit();

}

?>

<h2>Admin Dashboard</h2>

<h3>User Management</h3>

<a href="create_user.php">Create User</a><br><br>

<a href="users.php">View Users</a><br><br>

<a href="manage_users.php">Enable / Disable Users</a><br><br>

<a href="admin_recharge.php">Recharge User Account</a><br><br>


<h3>Transactions</h3>

<a href="transactions.php">View Transactions</a><br><br>


<h3>System</h3>

<a href="logout.php">Logout</a>
