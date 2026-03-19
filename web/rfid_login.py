import webbrowser
import time
from mfrc522 import SimpleMFRC522
import RPi.GPIO as GPIO

GPIO.setwarnings(False)

reader = SimpleMFRC522()

print("Scan card to login...")

while True:
    try:
        uid, text = reader.read()
        uid = str(uid)
        print("UID:", uid)
        break
    except:
        print("Retry...")
        time.sleep(1)

# 👉 打开浏览器自动登录
url = "http://10.3.183.15/rfid_login.php?uid=" + uid

print("Opening browser...")

webbrowser.open(url)
