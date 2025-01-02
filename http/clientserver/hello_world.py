from bottle import route, run, template

@route('/hello/<name>')
def index(name):
   return template('<b>Hello {{name}}</b>!', name=name)
run(host='localhost', port=8081,debug =True)


@route('/hello')
def index2():
   return "HELLO WORLD!"



run(host='localhost', port=8080,debug =True)