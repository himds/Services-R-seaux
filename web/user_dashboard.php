<?php

session_start();

if(!isset($_SESSION["user"])){

    header("Location: login.php");
    exit();

}

?>

<h2>User Dashboard</h2>

<a href="account.php">My account</a><br><br>

<a href="logout.php">Logout</a>
