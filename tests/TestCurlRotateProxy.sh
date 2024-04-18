#!/bin/bash


TOKEN=${1:-'TYPE_HERE_YOUR_PRIVATE_TOKEN'}
URL_TO_GET=${2:-'http://testpage.proxyrequest.ru/iamatestpage.html'}

SERVER_ADDRESS=${3:-'http://public.proxyrequest.ru'}


curl -X GET \
  "${SERVER_ADDRESS}/api/rotate/${TOKEN}?urlToGet=${URL_TO_GET}" \
  -H 'Content-Type: application/json'
