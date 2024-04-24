#!/bin/bash

# Default, additional field 'success' in response indicates result of operation
curl http://public.proxyrequest.ru/api/proxyget/free

# proxies only, json
curl http://public.proxyrequest.ru/api/proxyget/free?format=json

# proxies only, in csv
curl http://public.proxyrequest.ru/api/proxyget/free?format=csv

