<?php
error_reporting(E_ALL);

/* Allow the script to hang around waiting for connections. */
set_time_limit(0);

/* Turn on implicit output flushing so we see what we're getting
 * as it comes in. */
ob_implicit_flush();

$address = 'localhost';
$port = 10000;

if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
}

if (socket_bind($sock, $address, $port) === false) {
    echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
}

if (socket_listen($sock, 5) === false) {
    echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
}

do {
    if (($msgsock = socket_accept($sock)) === false) {
        echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n";
        break;
    }

    /* Send instructions. */
    $msg = "\nWelcome to the PHP Test Server. \n" .
        "To quit, type 'quit'.\n";
    socket_write($msgsock, $msg, strlen($msg));

    do {
        if (false !== ($buf = socket_read($msgsock, 2048))) {
          if ($buf == 'quit') {
              break;
          }
          else{
            $values = explode("|", $buf);

            if(count($values) == 2){
              if(floatval($values[0]) != 0 && floatval($values[1]) != 0){
                $conn = mysqli_connect('localhost', 'root', 'root', 'test');
                if(! $conn )
                {
                  die('Could not connect: ' . mysql_error());
                }
                $sql = 'INSERT INTO test '.
                       '(Sensor, Val) '.
                       'VALUES ('. $values[0] .', '. $values[1] .')';

                $retval = mysqli_query( $conn, $sql );
                if(! $retval )
                {
                  die('SQL QUERY NOT VALID.' . mysql_error());
                }
                error_log("SAVED");
                mysqli_close($conn);
              }
            }
				
			  $msg = "\nOK\n";
    		  socket_write($msgsock, $msg, strlen($msg));
              error_log("CLIENT:" . $buf, 0);
          }
        }
    } while (true);
    socket_close($msgsock);
    break;
} while (true);

socket_close($sock);
?>