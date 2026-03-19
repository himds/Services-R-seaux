<?php

// 调用 Python 脚本读取 RFID
$uid = shell_exec("python3 /home/pi/rfid-payment-system/rfid/rfid_read_once.py");

echo trim($uid);
?>
