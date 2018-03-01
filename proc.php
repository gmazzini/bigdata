<?php

$dir="/arubasyslog/log";
$files=scandir($dir);
$nfile=count($files);

for($i=0;$i<$nfile;$i++){
  if($files[$i]=="."||$files[$i]=="..")continue;
  $fp=fopen($dir."/".$files[$i],"r");
  fscanf($fp,"%ul %s %ul %d\n",$timestamp,$ip,$maca,$type);
  $data1[$ip][$maca]++;
  echo $ip." ";
  fclose($fp);
}

print_r($data1);


?>
