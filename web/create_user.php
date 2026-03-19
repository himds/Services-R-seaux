<?php
include "db.php";

if(isset($_POST["name"])){

    $name = $_POST["name"];
    $rfid = $_POST["rfid"];

    $stmt = $conn->prepare(
        "INSERT INTO users(name,rfid_uid,balance,status) VALUES(?,?,0,'active')"
    );

    $stmt->bind_param("ss", $name, $rfid);
    $stmt->execute();

    echo "✅ User created successfully";
}
?>

<h2>Create User</h2>

<!-- 选择方式 -->
<label>
<input type="radio" name="mode" value="manual" checked onclick="toggleMode()"> Manuel
</label>

<label>
<input type="radio" name="mode" value="rfid" onclick="toggleMode()"> RFID Scan
</label>

<br><br>

<form method="POST">

Name:<br>
<input type="text" name="name"><br><br>

<!-- 手动输入 -->
<div id="manualInput">
RFID UID:<br>
<input type="text" name="rfid" id="rfid"><br><br>
</div>

<!-- RFID 扫描 -->
<div id="rfidScan" style="display:none;">
<button type="button" onclick="scanRFID()">Scanner RFID</button>
<p id="result"></p>
</div>

<button type="submit">Create</button>

</form>

<br>
<a href="index.php">Back</a>

<script>
function toggleMode(){
    let mode = document.querySelector('input[name="mode"]:checked').value;

    if(mode === "manual"){
        document.getElementById("manualInput").style.display = "block";
        document.getElementById("rfidScan").style.display = "none";
    } else {
        document.getElementById("manualInput").style.display = "none";
        document.getElementById("rfidScan").style.display = "block";
    }
}

// 调用 Python RFID
function scanRFID(){
    fetch("scan.php")
    .then(response => response.text())
    .then(data => {
        document.getElementById("result").innerHTML = "UID: " + data;
        document.getElementById("rfid").value = data;
    });
}
</script>
