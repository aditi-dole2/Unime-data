import time
import json
import socket
import argparse
import threading


class Peer(object):
    def __init__(self) -> None:
        self.__buffer_size = 2048
        self.__neighbours = dict()

    def build_reader_socket(self, recv_port) -> None:
        """Build the reader feature of peer.
		
		It is based on UDP.
		"""
        self.__sock_recv = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
        print('binding reader peer ...')
        self.__sock_recv.bind(('0.0.0.0', recv_port))

    def build_writer_socket(self, send_port) -> None:
        """Build the writer feature of peer.
		
		It is based on UDP.
		"""
        self.__sock_send = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
        print('binding writer peer ...')
        self.__sock_send.bind(('0.0.0.0', send_port))


    def run_forever(self) -> None:
        t = threading.Thread(target=self.__run_forever_job)
        t.start()

    def __run_forever_job(self) -> None:
        while True:
            data = self.__sock_recv.recv(self.__buffer_size)
            if not data:
                continue
            data = data.decode()
            print('> peer recv %s' % (data))
            
            self.__logic(data)

    def __logic(self, data):
        try:
            data = json.loads(data)
            if data["type"] == "peer_sync_reply":
                self.__neighbours.update(data["neighbours"])
            elif data["type"] == "peer_data":
                print(data['payload'])
        except KeyError as e:
            print("Warning: the key does not exist. %s" % (e))
        return
    
    
    def unicast(self, message, address) -> None:
        """Send message to single node.
        Args:
            msg(str): message to be delivered
            address(tuple): the host, port tuple
        """
        message = message.encode('utf-8')
        self.__sock_send.sendto(message, address)
    
    def multicast(self, message, addresses) -> None:
        """Send message to multiple nodes.
        Args:
            msg(str): message to be delivered
            address(tuple): the host, port tuple
        """
        message = message.encode('utf-8')
        for address in addresses:
            self.__sock_send.sendto(message, address)

    def broadcast(self, message) -> None:
        """Send message to all nodes.
        Args:
            msg(str): message to be delivered
            address(tuple): the host, port tuple
        """
        message = message.encode('utf-8')
        for node_id in self.__neighbours.keys():
            address = (
                self.__neighbours[node_id]['host'],
                self.__neighbours[node_id]['destination_port']
            )
            self.__sock_send.sendto(message, address)

    def sync_request(self, message, address):
        print("sending peer sync ...")
        self.unicast(message, address)
        print("sending peer sync ... completed")


def main():
    
    parser = argparse.ArgumentParser()

    parser.add_argument('-r', '--reader-port',
                        dest='peer_reader_port',
                        help='Define the reader socket port',
                        type=int,
                        required=True)

    parser.add_argument('-w', '--writer-port',
                        dest='peer_writer_port',
                        help='Define the writer socket port',
                        type=int,
                        required=True)

    parser.add_argument('-i', '--id',
                        dest='node_id',
                        help='Define the node id',
                        type=int,
                        required=True)

    options = parser.parse_args()
    peer_reader_port = options.peer_reader_port
    peer_writer_port = options.peer_writer_port
    node_id = options.node_id
    rendezvous_port = 4003

    peer = Peer()
    peer.build_reader_socket(peer_reader_port)
    peer.build_writer_socket(peer_writer_port)
    peer.run_forever()

    destination_address = ('localhost', rendezvous_port)
    message = '{ \
        "node_id": %s, \
        "destination_port": %s, \
        "type": "peer_sync_request" \
    }' % (node_id, peer_reader_port)
    peer.sync_request(message, destination_address)
    time.sleep(1)

    message = '{ \
        "node_id": %s, \
        "payload": "Hey there", \
        "type": "peer_data" \
    }' % (node_id)
    peer.multicast(message)

if __name__ == '__main__':
    main()