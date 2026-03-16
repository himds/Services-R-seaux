<?php

session_start();
include "db.php";

$name = $_POST["name"];

$sql = "SELECT * FROM users WHERE name='$name' AND role='admin'";

$result = $conn->query($sql);

if($result->num_rows > 0){

    $_SESSION["admin"] = $name;

    header("Location: dashboard.php");

}else{

    echo "Login failed";

}

?>
