#!/bin/bash



COM="openssl genrsa -des3 -out ./demoCA/private/cakey.pem   4096"
echo $COM
$COM

