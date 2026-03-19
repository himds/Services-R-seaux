<?php
include "db.php";

$message = "";

if(isset($_POST["name"])){

    $name = $_POST["name"];
    $rfid = $_POST["rfid"];

    if(empty($rfid)){
        $message = "<p style='color:red;'>❌ Veuillez scanner une carte RFID !</p>";
    } else {

        // 🔍 检查 RFID 是否已存在
        $check = $conn->prepare("SELECT id FROM users WHERE rfid_uid=?");
        $check->bind_param("s", $rfid);
        $check->execute();
        $result = $check->get_result();

        if($result->num_rows > 0){
            $message = "<p style='color:red;'>❌ RFID déjà utilisé !</p>";
        } else {

            // ✅ 插入用户
            $stmt = $conn->prepare(
                "INSERT INTO users(name,rfid_uid,balance,status) VALUES(?,?,0,'active')"
            );

            $stmt->bind_param("ss", $name, $rfid);
            $stmt->execute();

            $message = "<p style='color:green;'>✅ Utilisateur créé avec succès</p>";
        }
    }
}
?>

<h2>Create User</h2>

<!-- 显示提示 -->
<?php echo $message; ?>

<!-- 选择方式 -->
<label>
<input type="radio" name="mode" value="manual" checked onclick="toggleMode()"> Manuel
</label>

<label>
<input type="radio" name="mode" value="rfid" onclick="toggleMode()"> RFID Scan
</label>

<br><br>

<form method="POST" onsubmit="return validateForm()">

Name:<br>
<input type="text" name="name" required><br><br>

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
// 切换模式
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
function scanRFID(){
    setInterval(() => {
    fetch("/scan.php")
    .then(r => r.text())
    .then(data => {
        if(data.trim() !== ""){
            document.getElementById("result").innerHTML = "UID: " + data;
            document.getElementById("rfid").value = data;
        }
    });
    }, 1000);
}
// 提交前验证
function validateForm(){
    let rfid = document.getElementById("rfid").value;

    if(rfid === ""){
        alert("Veuillez scanner une carte RFID !");
        return false;
    }
    return true;
}
</script>
