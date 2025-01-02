#!/bin/bash



COM="openssl genrsa -des3  -out private_key.pem 2048"
echo $COM
$COM

