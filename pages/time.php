<?php
require_once '../lib/class.video.php';
$log = @file_get_contents("../log.txt");
preg_match("/Duration:([^,]+)/", $log, $matches);
list($hours,$minutes,$seconds,$mili) = explode(":",$matches[1]);
$seconds = (($hours * 3600) + ($minutes * 60) + $seconds);
$seconds = round($seconds);
//echo $hours.'-'.$minutes.'-'.$seconds;
$page = @join("",@file("../log.txt"));
$kw = explode("time=", $page);
$last = array_pop($kw);
$values = explode(' ', $last);
$curTime = $values[0];
list($hours,$minutes,$seconds2) = explode(":",$curTime);
$seconds2 = (($hours * 3600) + ($minutes * 60) + $seconds2);
$seconds2 = round($seconds2);
$percent_extracted = @round((($seconds2 * 100)/($seconds)));
echo $percent_extracted;
$timeStamp = time();
$startStamp = $_COOKIE['startStamp'];
$etc = @floor(($timeStamp - $startStamp) * (100/$percent_extracted));
$etc = $startStamp + $etc;
$etc = @date('H:i:s ',@floor($etc-$timeStamp));
echo "::<strong>Time remaining:</strong> ".$etc;
list($timeStamp, $kbit) = explode("::",$_COOKIE['kbps']);
$last = explode("size= ",$page);
$last = array_pop($last);
$last = explode(" time=",$last);
$kb = $last[0];
$kb = str_replace('kB','',$kb);
$currentKb = $kb;
echo " | <strong>Speed:</strong> ". ($currentKb-$kbit)."kbps";
echo " | <strong>Current size:</strong> ".round($currentKb/1024)."mb";
setcookie('kbps',time().'::'.$currentKb,0,'/');
?>