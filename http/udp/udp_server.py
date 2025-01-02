import socket

def main():
    host = 'localhost'
    port = 8081
    hostname = (host,port)# tuple
    buffer_size =1024
    with socket.socket(socket.AF_INET, socket.SOCK_DGRAM) as s: # socket for udp
        s.bind((host,port))
        print('the server is ready to recieve...')
        while True:
            message,client_address = s.recvfrom(buffer_size) # recieves msg and returns tuple
            client_host, client_port = client_address
            print('recd msg from %s %s' %(client_host,client_port))
            s.sendto(message,client_address)



if __name__ == '__main__':
    main()
