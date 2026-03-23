<!DOCTYPE html>
<html>
<head>
    <title>RFID Login</title>
</head>
<body>

<h2>RFID Payment System</h2>

<h3>Login with RFID</h3>
<button onclick="startRFID()">Scan RFID Card</button>

<script>
function startRFID(){
    fetch("scan.php")
    .then(res => res.text())
    .then(data => {
        console.log("UID:", data);

        if(data !== "ERROR"){
            // 自动登录
            window.location.href = "login_process.php";
        } else {
            alert("Scan failed");
        }
    });
}
</script>

<br><br>

<h3>Manual Login (Backup)</h3>
<form action="login_process.php" method="POST">
    Name:<br>
    <input type="text" name="name"><br><br>
    <button type="submit">Login</button>
</form>

</body>
</html>
