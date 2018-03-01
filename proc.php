<?php

$dir="/arubasyslog/log";
$files=scandir($dir);
$nfile=count($files);
$data1=array();

for($i=0;$i<$nfile;$i++){
  if($files[$i]=="."||$files[$i]=="..")continue;
  $fp=fopen($dir."/".$files[$i],"r");
  for(;;){
    $myline=fscanf($fp,"%u %s %u %d\n");
    if(feof($fp))break;
    list($timestamp,$ip,$maca,$type)=$myline;
    $data1[$ip][$maca]++;
    echo "-->".$myline."\n";
    echo ">>>".$files[$i]." ".$ip." ".$maca."\n";
  }
  fclose($fp);
}

print_r($data1);


?>
