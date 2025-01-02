import socket

def main():
    host = 'localhost'
    port = 8082

    buffer_size =1024
    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s: # socket for udp
        s.bind((host,port))
        s.listen()

        conn, addr = s.accept()

        with conn:
            print('connected by', addr)
            while True:
                data = conn.recv(buffer_size)
                if not data:
                    break
                conn.sendall(data)

if __name__ == '__main__':
    main()
