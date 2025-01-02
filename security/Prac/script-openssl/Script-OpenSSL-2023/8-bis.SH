#!/bin/bash

#COM=" openssl ca -batch -in richiesta.pem -cert ./demoCA/certs/00.pem -keyfile ./demoCA/private/ca.key -out ./demoCA/newcerts/01.pem -days 365 -md sha256 -extensions v3_req"

COM="openssl ca -config openssl.cnf -policy policy_anything -out newcert.pem -days 3650 -in 
richiesta.pem"

echo $COM

$COM
