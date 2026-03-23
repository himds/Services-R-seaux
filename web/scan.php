<?php
session_start();

$cmd = "sudo python3 /home/pi/rfid-payment-system/rfid/rfid_read_once.py 2>&1"; $output = 
shell_exec($cmd); $uid = trim($output);
if ($uid == "") {
    echo "ERROR";
    exit;
}

// 存 UID
$_SESSION["rfid_uid"] = $uid;

echo $uid;
?>
