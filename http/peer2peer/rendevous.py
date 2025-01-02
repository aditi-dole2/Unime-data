import socket
from threading import Thread
import json

class Rendezvous:   #creating a object
    def __init__(self):#self represents the class itself
        self.__buffer_size = 2048  #creating a variable of the class self
        self.__neighbours = dict()

        #self.__buffer_size = 2048  (__) to make the variable private
    def build_socket(self,port):  # open a port for UDP
        self.__sock =  socket.socket(socket.AF_INET,socket.SOCK_DGRAM)
        print("binding rendezvous ...")
        self.__sock.bind(('0.0.0.0',port))
        
    #def build_callback(self,callback):
    #    self.__callback = callback

    def run_forever(self):
        t = Thread(target=self.__run_forever_job)
        t.start()
        
    def __run_forever_job(self):
        while True:
            data,address = self.__sock.recvfrom(self.__buffer_size)#reecieving packets(udp)
            if not data: #check
                continue
            data = data.decode() #convert data to string
            print('> rdv recv %s' % (data))
            self.__logic(data,address)

    def __node_in_neighbours(self, node_id) -> bool:
        return node_id in self.__neighbours

    def __insert_neighbour(self, node_id, host, data) -> None:
        self.__neighbours[node_id] = {
            "host": host, 
            "destination_port": data['destination_port']
        }

    def __logic(self,data,address):
        try:
            data = json.loads(data) #transform json string to dict
            if data['type'] == 'peer_sync_request':
                client_node_id = data['node_id']
                if not self.__node_in_neighbours(client_node_id):
                    print('new connection from %s - %s:%s' % (client_node_id, address[0], address[1]))
                self.__insert_neighbour(client_node_id, address[0], data)
                message = self.__create_message(data)
                self.__sync_reply(message)
        except KeyError as e:
            print("Warning: the key does not exist. %s" % (e))

    def __create_message(self, data) -> str:
        """Create a protocol message.
        The message is defined as follow:
            {
                "node_id": <string>,
                "type": <string>,
                "neighbours": <dict>
            }
        Args:
            data(): ...
        Returns:
            (str) protocol message.
        """
        neighbours_str = json.dumps(self.__neighbours)
        return '{ \
            "node_id": %s, \
            "type": "peer_sync_reply", \
            "neighbours": %s \
        }' % (data['node_id'], neighbours_str)
            
    def __sync_reply(self, message) -> None:
        message = message.encode('utf-8')
        for node_id in self.__neighbours.keys():
            address = (
                self.__neighbours[node_id]['host'],
                self.__neighbours[node_id]['destination_port'])
            self.__sock.sendto(message, address)

    
def main():
    rendezvous_port = 4003
    rendezvous = Rendezvous()

    rendezvous.build_socket(rendezvous_port)
    rendezvous.run_forever()


if __name__ == '__main__':
    main()
