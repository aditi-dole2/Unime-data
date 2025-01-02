#!/bin/bash
COM="openssl x509 -in ./demoCA/cacert.pem -outform der -out  certificato.der"
$COM
