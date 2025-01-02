import requests 
import json 

protocol ='http://'
hostname ='localhost:8081' #change ip address to server computer ipaddrtess

print('>> create two new products')
pathname ='/products'
url = '%s%s%s'% (protocol,hostname,pathname)
body = json.dumps( {"pizza": 1, "water": 6} )
headers = {"Content-Type": "application/json"}
r = requests.post(url, data=body, headers=headers)
print(r.text)

print('>> list all products')
url = '%s%s%s'% (protocol,hostname,pathname)
r = requests.get(url)
print(r.text)

print('>> update a product')
pathname = '/products/pizza'
url = '%s%s%s' % (protocol, hostname, pathname)
body = '2'
headers = {"Content-Type": "text/plain"}
r = requests.put(url, data=body, headers=headers)
print(r.text)

print('>> delete a product')
pathname = '/products/water'
url = '%s%s%s' % (protocol, hostname, pathname)
r = requests.delete(url)
print(r.text)

print('>> list all products')
pathname = '/products'
url = '%s%s%s' % (protocol, hostname, pathname)
r = requests.get(url)
print(r.text)
