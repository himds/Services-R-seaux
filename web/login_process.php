<?php
session_start();
include "db.php";  // 数据库连接

// ==========================
// 🔵 1. RFID 登录
// ==========================
if (isset($_SESSION["rfid_uid"])) {

    $uid = $_SESSION["rfid_uid"];

    // ✅ 推荐：直接在 SQL 里限制 active
    $sql = "SELECT * FROM users 
            WHERE rfid_uid='$uid' AND status='active'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $name = $row["name"];

        // ✅ 根据角色跳转
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
        // ❌ 用户不存在 或 被禁用
        echo "<script>alert('❌ Access denied or account disabled!'); window.location.href='login.php';</script>";
    }

    exit;
}


// ==========================
// 🟡 2. 手动登录（备用）
// ==========================
if (isset($_POST["name"])) {

    $name = $_POST["name"];

    // ✅ 同样限制 status
    $sql = "SELECT * FROM users 
            WHERE name='$name' AND status='active'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        // ✅ 根据角色跳转
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
        echo "<script>alert('❌ User not found or account disabled!'); window.location.href='login.php';</script>";
    }

    exit;
}


// ==========================
// 🔴 3. 非法访问
// ==========================
echo "<script>alert('❌ Invalid access!'); window.location.href='login.php';</script>";
exit;
?>
