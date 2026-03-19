<?php

$amount = $_POST["amount"];

// 调用 Python 支付程序
$command = "sudo python3 /home/pi/rfid-payment-system/rfid/rfid_payment.py $amount";

$output = shell_exec($command);

echo "<h2>Payment Result</h2>";

echo "<pre>$output</pre>";

echo "<br><a href='merchant_dashboard.php'>Back</a>";

?>
