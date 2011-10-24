<?php

if(preg_match('/\d{7,10}/',$_GET['id']))
{
set_time_limit(36000);
require_once 'lib/class.video.php';
unlink("log.txt");
$video=new Video;
$xml = $video->getClipInfo($_GET['id']);
$flv = $xml->video_file_url;
$title = $video->parseTitle($xml->title).'_part'.$_GET['part'].'_'.$_GET['id'];
if(!is_dir("converted")) { @mkdir("converted",0777); }
exec("ffmpeg.exe -threads 8 -i ".$flv." -vcodec wmv2 -sameq -acodec wmav2 -f asf converted/{$title}.asf  1>log.txt 2>&1", $output);
exec("ffmpeg.exe -itsoffset -4  -i converted/{$title}.asf -vcodec mjpeg -vframes 1 -an -f rawvideo -s 1024x600 converted/{$title}.jpg",$output);
}
elseif($_GET['id']=="xsplit")
{
set_time_limit(36000);
require_once 'lib/class.video.php';
unlink("log.txt");
$video=new Video;
$file=$_GET['part'];
$title=str_replace('.flv','',$file);
if(!is_dir("converted")) { @mkdir("converted",0777); }
exec("ffmpeg.exe -i xsplit/".$file." -vcodec wmv2 -sameq -acodec wmav2 -f asf converted/{$title}.asf  1>log.txt 2>&1", $output);
exec("ffmpeg.exe -itsoffset -4  -i converted/{$title}.asf -vcodec mjpeg -vframes 1 -an -f rawvideo -s 1024x600 converted/{$title}.jpg",$output);	
echo '1';
}
?>