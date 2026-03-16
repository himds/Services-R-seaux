<?php

$conn = new mysqli(
    "localhost",
    "rfid",
    "1234",
    "rfid_payment"
);

if ($conn->connect_error) {
    die("Connection failed");
}

?>
