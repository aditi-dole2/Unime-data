from bottle import request,response
from bottle import post,get,put,delete
import json
from bottle import route, run, template

data = dict()


@post('/products')
def create_product():
    body = json.loads(request.body.read())
    #print(type(body))
    data.update(body)
    #print(data)
    return data 

@get('/products')
def get_products():
    response.headers['Content-Type'] = 'application/json'
    response.headers['Cache-Control'] = 'no-cache'
    response.headers['Personal-Key'] = 'value'
    return json.dumps(data)

@put('/products/<product>')
def update_product(product):
    body = int(request.body.read())
    if product in data.keys():
        data[product] = body
    return data

@delete('/products/<product>')
def delete_product(product):
    if product in data.keys():
        del data[product]

    return data




def main():
    print(data)
    run(host='localhost', port=8081,debug =True)#only one host
    #run(host='0.0.0.0', port=8081,debug =True) #all host # change the ipaddress to client computer ipaddress
    pass

if __name__ == '__main__':
    main()



#commmand prompt 1 SERVER
##C:\Users\Aditi\Downloads\curl-7.85.0_8-win32-mingw\curl-7.85.0_8-win32-mingw>curl -v -X POST --data "{'pizza' :2}" http://localhost:8081/products
'USE ABOVE COMMAND TO CHANGE METHOD [POST,GET,PUT,DELETE]'

#commmand prommpt2 CLIENT
##C:\Users\Aditi\computer_networks\http>python http_server.py
#"""{}
#Bottle v0.12.23 server starting up (using WSGIRefServer())...
#Listening on http://localhost:8081/
#Hit Ctrl-C to quit.

#<frozen importlib._bootstrap>:914: ImportWarning: _ImportRedirect.find_spec() not found; falling back to find_module()
#Traceback (most recent call last):
 # File "C:\Users\Aditi\AppData\Local\Programs\Python\Python310\lib\site-packages\bottle.py", line 876, in _handle
  #  return route.call(**args)
  #ile "C:\Users\Aditi\AppData\Local\Programs\Python\Python310\lib\site-packages\bottle.py", line 1756, in wrapper
   # rv = callback(*a, **ka)
  #file "C:\Users\Aditi\computer_networks\http\http_server.py", line 12, in create_product
 #   body = json.loads(request.body.read())
  #File "C:\Users\Aditi\AppData\Local\Programs\Python\Python310\lib\json\__init__.py", line 346, in loads
    #return _default_decoder.decode(s)
  #File "C:\Users\Aditi\AppData\Local\Programs\Python\Python310\lib\json\decoder.py", line 337, in decode
   # obj, end = self.raw_decode(s, idx=_w(s, 0).end())
  #File "C:\Users\Aditi\AppData\Local\Programs\Python\Python310\lib\json\decoder.py", line 353, in raw_decode
   # obj, end = self.scan_once(s, idx)
#json.decoder.JSONDecodeError: Expecting property name enclosed in double quotes: line 1 column 2 (char 1)
#127.0.0.1 - - [18/Oct/2022 10:32:30] "POST /products HTTP/1.1" 500 2043
#"""





