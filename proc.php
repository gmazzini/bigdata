<?php

$dir="/arubasyslog/log";
$files=scandir($dir);
$nfile=count($files);
error_reporting(0);

$data1=array();
$data2=array();

for($i=0;$i<$nfile;$i++){
  if($files[$i]=="."||$files[$i]=="..")continue;
  $fp=fopen($dir."/".$files[$i],"r");
  for(;;){
    $myline=fscanf($fp,"%u %s %u %d\n");
    if(feof($fp))break;
    list($timestamp,$ip,$maca,$type)=$myline;
    $data1[$ip][$maca]++;
    $data2[$maca]++;
  }
  fclose($fp);
}

ksort($data1);
$cc1=0;
foreach($data1 as $key => $value ){
$cc2=count($value);
$cc1+=$cc2;
  echo $key." ".$cc2."\n";
}
echo $cc1."\n";

echo count($data2)."\n";


?>
