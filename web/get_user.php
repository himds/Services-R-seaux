<?php

include "db.php";

$uid = $_GET["uid"];

$sql = "SELECT * FROM users WHERE rfid_uid='$uid' AND status='active'";

$result = $conn->query($sql);

if($result->num_rows > 0){

    $row = $result->fetch_assoc();

    echo json_encode($row);

}else{

    echo "NOT_FOUND";

}

?>
