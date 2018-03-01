<?php

$dir="/arubasyslog/log";
$files=scandir($dir);
$nfile=count($files);

for($i=0;$i<$nfile;$i++){
  if($files[$i]=="."||$files[$i]=="..")continue;
  print($files[$i]);
}



?>
