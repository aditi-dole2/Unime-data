#!/bin/bash
COM="openssl  x509 -text -in demoCA/cacert.pem"

echo $COM

$COM
