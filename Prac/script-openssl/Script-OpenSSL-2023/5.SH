#!/bin/bash



COM="openssl req -new -x509 -days 3650 -key ./demoCA/private/cakey.pem -out ./demoCA/cacert.pem "
echo $COM
$COM

