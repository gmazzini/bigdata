<?php

$dir="/arubasyslog/log";
$files=scandir($dir);
$nfile=count($files);
$data1=array();

for($i=0;$i<$nfile;$i++){
  if($files[$i]=="."||$files[$i]=="..")continue;
  $fp=fopen($dir."/".$files[$i],"r");
  for(;;){
    fscanf($fp,"%ul %s %ul %d\n",$timestamp,$ip,$maca,$type);
    if(feof($fp))break;
    $data1[$ip][$maca]++;
    echo $ip." ";
  }
  fclose($fp);
}

print_r($data1);


?>
