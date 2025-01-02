#!/bin/bash
COM="openssl ca -gencrl -out ./demoCA/crl/crl.pem"
$COM
