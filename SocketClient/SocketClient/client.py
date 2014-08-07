#!/usr/bin/env python

import socket
import time

TCP_IP = '127.0.0.1'
TCP_PORT = 10000
BUFFER_SIZE = 2048

#! BEGIN CONNECTION
try:
	s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
except socket.error, msg:
  sys.stderr.write("[ERROR] %s\n" % msg[1])
  sys.exit(1)


try:
	s.connect((TCP_IP, TCP_PORT))
except socket.error, msg:
  sys.stderr.write("[ERROR] %s\n" % msg[1])
  sys.exit(2)
#! END CONNECTION

#BEGIN LOGIC
loop = True;

while(loop):
    data = s.recv(BUFFER_SIZE)
    print data
    MESSAGE=raw_input("Enter: ")
    MESSAGE = MESSAGE
    s.send(MESSAGE)
    time.sleep(1)
    
    if(MESSAGE == "quit"):
        loop = False

#END LOGIC
	
s.close()
