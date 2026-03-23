<?php
session_start();
include "db.php";

if (isset($_SESSION["rfid_uid"])) {

    $uid = $_SESSION["rfid_uid"];

    $sql = "SELECT * FROM users WHERE rfid_uid='$uid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        // ✅ 用户存在 → 登录
        $row = $result->fetch_assoc();
        $name = $row["name"];

        if ($row["role"] == "admin") {
            $_SESSION["admin"] = $name;
            header("Location: dashboard.php");
        } elseif ($row["role"] == "merchant") {
            $_SESSION["merchant"] = $name;
            header("Location: merchant_dashboard.php");
        } else {
            $_SESSION["user"] = $name;
            header("Location: user_dashboard.php");
        }

    } else {

        // ❌ UID不存在 → 跳转注册页面
        header("Location: register.php");
    }

    exit;
}

// 备用：手动登录（不变）
if (isset($_POST["name"])) {

    $name = $_POST["name"];
    $sql = "SELECT * FROM users WHERE name='$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        if ($row["role"] == "admin") {
            $_SESSION["admin"] = $name;
            header("Location: dashboard.php");
        } elseif ($row["role"] == "merchant") {
            $_SESSION["merchant"] = $name;
            header("Location: merchant_dashboard.php");
        } else {
            $_SESSION["user"] = $name;
            header("Location: user_dashboard.php");
        }

    } else {
        echo "Login failed";
    }
}
?>
