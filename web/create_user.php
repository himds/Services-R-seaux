<?php
include "db.php";

if(isset($_POST["name"])){

    $name = $_POST["name"];
    $rfid = $_POST["rfid"];

    $sql = "INSERT INTO users(name,rfid_uid,balance,status)
            VALUES('$name','$rfid',0,'active')";

    $conn->query($sql);

    echo "User created successfully";
}
?>

<h2>Create User</h2>

<form method="POST">

Name:<br>
<input type="text" name="name"><br><br>

RFID UID:<br>
<input type="text" name="rfid"><br><br>

<button type="submit">Create</button>

</form>

<br>
<a href="index.php">Back</a>
