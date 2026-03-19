<?php
session_start();

if(!isset($_SESSION["merchant"])){

header("Location: login.php");
exit();

}
?>

<h2>Merchant Dashboard</h2>

<form action="start_payment.php" method="POST">

Enter amount:<br>
<input type="number" name="amount"><br><br>

<button type="submit">Start Payment</button>

</form>

<br>

<a href="logout.php">Logout</a>
