<?php
session_start();
include "db.php";

// 必须是 admin
if (!isset($_SESSION["admin"])) {
    echo "Access denied";
    exit;
}

// 如果已经扫到卡
if (isset($_SESSION["rfid_uid"])) {

    $uid = $_SESSION["rfid_uid"];

    if (isset($_POST["amount"])) {

        $amount = $_POST["amount"];

        // 更新余额
        $sql = "UPDATE users SET balance = balance + $amount WHERE rfid_uid='$uid'";
        $conn->query($sql);

        echo "Recharge success for UID: $uid";

        // 清掉 UID（避免重复充值）
        unset($_SESSION["rfid_uid"]);
    }
}
?>

<h2>Admin RFID Recharge</h2>

<button onclick="scanCard()">Scan Card</button>

<p id="uid"></p>

<form method="POST">
    Amount:<br>
    <input type="number" name="amount" required><br><br>
    <button type="submit">Recharge</button>
</form>

<script>
function scanCard(){
    fetch("scan.php")
    .then(res => res.text())
    .then(data => {
        document.getElementById("uid").innerText = "UID: " + data;
    });
}
</script>
