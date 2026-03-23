<?php
session_start();
include "db.php";

// 检查 UID 是否存在
if (!isset($_SESSION["rfid_uid"])) {
    echo "Error: No UID detected";
    exit;
}

$uid = $_SESSION["rfid_uid"];

if (isset($_POST["name"]) && isset($_POST["role"])) {

    // 防止 SQL 注入（基础版）
    $name = $conn->real_escape_string($_POST["name"]);
    $role = $conn->real_escape_string($_POST["role"]);

    // ❗检查 UID 是否已注册
    $check = $conn->query("SELECT * FROM users WHERE rfid_uid='$uid'");
    if ($check->num_rows > 0) {
        echo "This card is already registered!";
        exit;
    }

    // 插入用户
    $sql = "INSERT INTO users (name, rfid_uid, balance, status, role)
            VALUES ('$name', '$uid', 0, 'active', '$role')";

    if ($conn->query($sql)) {

        // ❗清除 UID（防止重复使用）
        unset($_SESSION["rfid_uid"]);

        // 登录并跳转
        if ($role == "merchant") {
            $_SESSION["merchant"] = $name;
            header("Location: merchant_dashboard.php");
        } else {
            $_SESSION["user"] = $name;
            header("Location: user_dashboard.php");
        }

        exit;

    } else {
        echo "SQL Error: " . $conn->error;
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register New Account</h2>

<p>UID: <?php echo $uid; ?></p>

<form method="POST">
    Name:<br>
    <input type="text" name="name" required><br><br>

    Role:<br>
    <select name="role">
        <option value="user">User</option>
        <option value="merchant">Merchant</option>
    </select><br><br>

    <button type="submit">Create Account</button>
</form>

</body>
</html>
