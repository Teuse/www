<?php

  $link = mysql_connect("localhost", "teuse", "Mattes12pi")
      or die("Error: Couldn't connect to MySQL server" . mysql_error());
  mysql_select_db("logging")
    or die("Error: Couldn't connect to DB logging");

  // Ausführen einer SQL-Anfrage
  $query = "SELECT * FROM Internet";
  $result = mysql_query($query) or die("Error: query failed " . mysql_error());


  $down = array();
  $up   = array();
  $date = array();
  $time = array();

  while ( $row = mysql_fetch_row ( $result ) )
  {
    array_push($date, $row[1]);
    array_push($time, $row[2]);
    array_push($down, (float)$row[3]);
    array_push($up,   (float)$row[4]);
  }

  $toJS = array(
    "download" => $down,
    "upload"   => $up,
    "date"     => $date,
    "time"     => $time,
  );
  echo json_encode($toJS);

  mysql_free_result ( $result );
  mysql_close($link);
?>
