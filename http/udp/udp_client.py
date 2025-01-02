import socket

def main():
    host = 'localhost'
    port = 8081
    hostname = (host,port)# tuple
    buffer_size =1024
    # IPV4 address family over UDP
    with socket.socket(socket.AF_INET, socket.SOCK_DGRAM) as s: # socket for udp
            message = input("type the msg you want  ")
            s.sendto(str.encode(message),(host,port))

            message_back, server_address = s.recvfrom(buffer_size)
            server_host, server_port = server_address
        
            print('recd msg from \'%s\' back from  server %s %s' % (message_back.decode(),server_host, server_port))
            



if __name__ == '__main__':
    main()
