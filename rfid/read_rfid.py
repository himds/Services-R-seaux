import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522

reader = SimpleMFRC522()

try:
    print("Place your RFID card")

    id = reader.read()

    print("RFID UID:", id)
finally:
    GPIO.cleanup()
