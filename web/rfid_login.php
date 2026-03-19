<?php

session_start();
include "db.php";

$uid = $_GET["uid"];

$sql = "SELECT * FROM users WHERE rfid_uid='$uid' AND status='active'";
$result = $conn->query($sql);

if($result->num_rows > 0){

    $row = $result->fetch_assoc();

    if($row["role"] == "admin"){

        $_SESSION["admin"] = $row["name"];
        header("Location: dashboard.php");

    }elseif($row["role"] == "merchant"){

        $_SESSION["merchant"] = $row["name"];
        header("Location: merchant_dashboard.php");

    }else{

        $_SESSION["user"] = $row["name"];
        header("Location: user_dashboard.php");

    }

}else{

    echo "User not found";

}
?>
