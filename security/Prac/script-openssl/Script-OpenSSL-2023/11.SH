#/bin/bash
COM="openssl pkcs12 -export -in ./demoCA/newcerts/01.pem -inkey private_key.pem -certfile demoCA/cacert.pem -out mvillari.p12"
$COM
