#!/bin/bash

echo "Installing RFID Payment System..."

sudo apt update

sudo apt install apache2 php php-mysql mariadb-server python3-pip -y

pip3 install mfrc522
pip3 install mysql-connector-python

echo "Creating database..."

mysql -u root < database/schema.sql

echo "Copying web files..."

sudo cp web/* /var/www/html/

echo "Installation complete!"
