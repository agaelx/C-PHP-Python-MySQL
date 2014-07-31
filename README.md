C-PHP-Python-MySQL
==================

Quick samples on how to interconnect a C++ socket client into a PHP server with sockets in order to save data into MySQL. with a PHP HTTP Rest Service to retrieve the DB data (Useful for Electronics that use C++)

HELP:

0) Run server on:
	http://localhost/C-PHP-Python-MySQL/socket-server.php

2) PHP REST SERVICE URL to request and READ from SQL DATA, (Modify the sensor value and the server domain).
	http://localhost/C-PHP-Python-MySQL/getdata.php?sensor=8

3) TERMINAL COMMAND TO SHOW PHP SERVER LOGS and monitor PHP events, I’m using mamp but you can locate your php_error.log file instead.
	 tail -f /Applications/MAMP/logs/php_error.log 

4)I used a sample database:
 database name: “test” 
 table : “test” with 3 columns (‘ID’, ‘Sensor’, ‘Val’)
 
 run createDBandTable.sql in your MySQL DB.
