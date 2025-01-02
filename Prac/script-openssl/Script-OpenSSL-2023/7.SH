#!/bin/bash

cd ./demoCA/
cp cacert.pem ./certs/00.pem
cd ./certs/ 
ln -s 00.pem `openssl x509 -hash -noout -in 00.pem`.0
cd ../../
