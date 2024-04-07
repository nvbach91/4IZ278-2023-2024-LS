<?php
header("Cache-Control: no-cache");
header("Content-Type: text/event-stream");

while (true) {
  $counter = rand(1, 10);
  $time = date('H:m:s');
  $eventType = $counter % 2 == 0 ? 'counter' : 'time';
  $data = $eventType == 'counter' ? $counter : $time;
  echo "event: $eventType\n";
  echo "data: $data\n\n";
  if (ob_get_length() > 0) {
    ob_end_flush();
  }
  flush();

  // Break the loop if the client aborted the connection (closed the page)
  if (connection_aborted()) {
    exit();
  }
  sleep(1);
}

?>

