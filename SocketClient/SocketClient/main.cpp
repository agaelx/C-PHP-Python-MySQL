//
//  main.cpp
//  SocketClient
//
//  Created by Uriel Garcia on 31/07/14.
//  Copyright (c) 2014 Agarcia. All rights reserved.

//TCP CLIENT
#include <iostream>
#include<sys/socket.h>
#include<netinet/in.h>
#include<stdio.h>
#include<string.h>
#include<stdlib.h>
#include <arpa/inet.h>
#include <unistd.h>

int main(int argc, const char * argv[]) {
    int sock_desc = socket(AF_INET, SOCK_STREAM, 0);
    if (sock_desc == -1)
    {
        printf("cannot create socket!\n");
        return 0;
    }
    
    struct sockaddr_in client;
    memset(&client, 0, sizeof(client));
    client.sin_family = AF_INET;
    client.sin_addr.s_addr = inet_addr("127.0.0.1");
    client.sin_port = htons(10000);
    
    if (connect(sock_desc, (struct sockaddr*)&client, sizeof(client)) != 0)
    {
        printf("cannot connect to server!\n");
        close(sock_desc);
    }
    
    char buf[2048];
    char *p_buf;
    int k, len;
    
    while(1)
    {
        scanf("%s",buf);
        
        len = (int)strlen(buf);
        p_buf = buf;
        
        while (len > 0)
        {
            k = (int)send(sock_desc, p_buf, len, 0);
            if (k == -1)
            {
                printf("cannot write to server!\n");
                break;
            }
            
            p_buf += k;
            len -= k;
        }
        
        if (strcmp(buf, "exit") == 0)
            break;
    }
    
    close(sock_desc);
    printf("client disconnected\n");
    
    return 0;
}
