<?php
// v0.13

$dir="/arubasyslog/log";
$files=scandir($dir);
$nfile=count($files);
error_reporting(0);

$data1=array();
$data2=array();
$data3=array();

for($i=0;$i<$nfile;$i++){
  if($files[$i]=="."||$files[$i]=="..")continue;
  $fp=fopen($dir."/".$files[$i],"r");
  for(;;){
    $myline=fscanf($fp,"%u %s %u %d\n");
    if(feof($fp))break;
    list($timestamp,$ip,$maca,$type)=$myline;
    $data1[$ip][$maca]++;
    $data2[$maca]++;
    if($type==1 && $data3[$ip][$maca]["last"]!=1){
      $data3[$ip][$maca]["time"]=$timestamp;
      $data3[$ip]["user"]++;
      $data3[$ip]["event"]++;
    }
    if(($type==2||$type==3) && $data3[$ip][$maca]["last"]==1){
      if($data3[$ip]["user"]>0)$data3[$ip]["user"]--;
      $data3[$ip]["acctime"]+=($timestamp-$data3[$ip][$maca]["time"]);
      $data3[$ip]["accuser"]+=$data3[$ip]["user"];
    }
    $data3[$ip][$maca]["last"]=$type;
  }
  fclose($fp);
}

ksort($data1);
$totuser=0;
$totap=0;
$minuser=10000000;
$maxuser=0;
foreach($data1 as $ip => $value ){
  $cc2=count($value);
  $totuser+=$cc2;
  $totap++;
  if($cc2<$minuser)$minuser=$cc2;
  if($cc2>$maxuser)$maxuser=$cc2;
  $avetime=$data3[$ip]["acctime"]/$data3[$ip]["event"];
  $aveuser=$data3[$ip]["accuser"]/$data3[$ip]["event"];
  $hostname=gethostbyaddr($ip);
  printf("%s %s %d %.2f %.2f\n",$ip,$hostname,$cc2,$aveuser,$avetime);
}
echo "UserUniqueAP=".$totuser."\n";
echo "TotalUser=".count($data2)."\n";
echo "TotAP=".$totap."\n";
printf("UserperAP=%.2f\n",$totuser/$totap);
echo "minUserAP=".$minuser."\n";
echo "maxUserAP=".$maxuser."\n";


?>
