from mfrc522 import SimpleMFRC522
import RPi.GPIO as GPIO
GPIO.setwarnings(False)
GPIO.cleanup()


reader = SimpleMFRC522()

try:
    uid, text = reader.read()
    print(uid)
finally:
    GPIO.cleanup()
