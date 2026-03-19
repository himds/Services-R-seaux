<?php
session_start();
include "db.php";

$name = $_SESSION["user"];

if(isset($_POST["amount"])){

$amount = $_POST["amount"];

$conn->query("
UPDATE users 
SET balance = balance + $amount
WHERE name='$name'
");

echo "Recharge successful";

}
?>

<h2>Recharge Account</h2>

<form method="POST">

Amount:<br>
<input type="number" name="amount"><br><br>

<button type="submit">Recharge</button>

</form>

<br>
<a href="account.php">Back</a>
