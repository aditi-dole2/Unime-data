#!/bin/bash



COM="openssl req -new  -key private_key.pem -out richiesta.pem"
echo $COM
$COM

