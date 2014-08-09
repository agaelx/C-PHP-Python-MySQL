//
//  main.cpp
//  test
//
//  Created by Uriel Garcia on 06/08/14.
//  Copyright (c) 2014 Agarcia. All rights reserved.
//

#include <iostream>
#include <sys/socket.h>
#include <netinet/in.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <arpa/inet.h>
#include <unistd.h>
#include <cstdio>

int main(int argc, const char * argv[]) {

    char buffer [256];
    float sensor_v=123.334f;
    
    sprintf(buffer, "%0.3f", sensor_v);
    printf("[%s] is a string \n", buffer);

    //int n, a=5, b=3;
    //n=sprintf (buffer, "%d plus %d is %d", a, b, a+b);
    //printf ("[%s] is a string %d chars long\n",buffer,n);
    
    return 0;
}
