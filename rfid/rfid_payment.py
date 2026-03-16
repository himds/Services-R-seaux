import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522
import mysql.connector
from decimal import Decimal
import time
import sys

# GPIO 设置
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)

# LED 引脚
GREEN_LED = 17
RED_LED = 27

GPIO.setup(GREEN_LED, GPIO.OUT)
GPIO.setup(RED_LED, GPIO.OUT)

# RFID 读取器
reader = SimpleMFRC522()

# 数据库连接
db = mysql.connector.connect(
    host="localhost",
    user="rfid",
    password="1234",
    database="rfid_payment"
)

cursor = db.cursor()

# 输入金额
amount = Decimal(sys.argv[1])

try:

    print("Scan card")

    uid, text = reader.read()
    uid = str(uid)

    cursor.execute(
        "SELECT id,name,balance FROM users WHERE rfid_uid=%s",
        (uid,)
    )

    user = cursor.fetchone()

    if user:

        user_id = user[0]
        name = user[1]
        balance = user[2]

        print("User:", name)
        print("Current balance:", balance)

        if balance >= amount:

            new_balance = balance - amount

            cursor.execute(
                "UPDATE users SET balance=%s WHERE id=%s",
                (new_balance, user_id)
            )

            cursor.execute(
                "INSERT INTO transactions(user_id,amount,type) VALUES(%s,%s,'payment')",
                (user_id, amount)
            )

            db.commit()

            print("Payment success")
            print("New balance:", new_balance)

            GPIO.output(GREEN_LED, GPIO.HIGH)
            time.sleep(2)
            GPIO.output(GREEN_LED, GPIO.LOW)

        else:

            print("Payment failed: insufficient balance")

            GPIO.output(RED_LED, GPIO.HIGH)
            time.sleep(2)
            GPIO.output(RED_LED, GPIO.LOW)

    else:

        print("Unknown card")

finally:

    GPIO.cleanup()
