<?php

for($i=1;$i<17;$i++){
  $query =  "INSERT INTO TRack (Rack_ID) VALUES $i";
  echo $result."\t".$query.";<br>\n";
}

for($i=1;$i<10;$i++)
  for($j=1;$j<4;$j++)
    for($k=1;$k<17;$k++){
      $query =  "INSERT INTO TLocal (Bloco_ID, Andar_ID, Rack_ID) VALUES ($i,$j,$k)";
      echo $result."\t".$query.";<br>\n";
    }

for($i=1;$i<49;$i++){
  $query =  "INSERT INTO TPort (Port_ID) VALUES $i";
  echo $result."\t".$query.";<br>\n";
}

for($i=1;$i<5;$i++)
  for($j=1;$j<25;$j++){
    $query =  "INSERT INTO TPatch_Panel (Patch_ID,Port_ID) VALUES ($i,$j)";
    echo $result."\t".$query.";<br>\n";
  }
?>
