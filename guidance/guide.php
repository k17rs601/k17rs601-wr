<?php
  $i = 0;
  while(true) {
    echo date("Y/m/d H:i:s");
    echo '<br/>';
    sleep(5);
    $i = $i + 1;
    if ($i == 5) {
      break;
    }
  }