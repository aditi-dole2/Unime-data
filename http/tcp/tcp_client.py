import socket
def main():
    host = 'localhost'
    port = 8082
    hostname = (host,port)
    buffersize = 1024

    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        s.connect((host, port))
        message = input("Type you message - ")
        s.sendall(str.encode(message))
        data = s.recv(buffersize)

    print('Received', data.decode())

if __name__ == '__main__':
    main()