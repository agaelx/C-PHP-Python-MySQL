<?php
  $conn = mysqli_connect('localhost', 'root', 'root', 'test');
  if(! $conn )
  {
   die('Could not connect: ' . mysql_error());
  }
  $sql = "SELECT * FROM test WHERE Sensor = " . $_GET['sensor'];
  $result = mysqli_query($conn,$sql);

  if(!$result )
  {
    die('Could not retrieve data. ' . mysql_error());
  }
  else
  {
    error_log("VALID QUERY FROM REQUEST.");

    while($row = mysqli_fetch_array($result)) {
      echo "SENSOR:" . $row['Sensor'] . " " . "VALUE:" . $row['Val'];
      echo "<br>";
    }
  }
  mysqli_close($conn);
?>