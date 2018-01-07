<?php

  $link = mysql_connect("localhost", "teuse", "Mattes12pi")
      or die("Error: Couldn't connect to MySQL server" . mysql_error());
  mysql_select_db("logging")
    or die("Error: Couldn't connect to DB logging");

  // Ausführen einer SQL-Anfrage
  $query = "SELECT * FROM Temperatures";
  $result = mysql_query($query) or die("Error: query failed " . mysql_error());


  $cpu   = array();
  $raspi = array();
  $room  = array();
  $date  = array();
  $time  = array();

  while ( $row = mysql_fetch_row ( $result ) )
  {
    array_push($date,  $row[1]);
    array_push($time,  $row[2]);
    array_push($cpu,   (float)$row[3]);
    array_push($raspi, (float)$row[4]);
    array_push($room,  (float)$row[5]);
  }

  $toJS = array(
    "cpu"   => $cpu,
    "raspi" => $raspi,
    "room"  => $room,
    "date"  => $date,
    "time"  => $time,
  );
  echo json_encode($toJS);

  mysql_free_result ( $result );
  mysql_close($link);
?>
