#!/bin/bash
COM="openssl pkcs12 -in MVILLARI.P12 -out mvil_cert.pem -clcerts -nokeys"
$COM
