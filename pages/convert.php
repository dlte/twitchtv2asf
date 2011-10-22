<?php

if(preg_match('/\d{7,10}/',$_GET['id']))
{
require_once '../lib/class.video.php';
unlink("../log.txt");
$video=new Video;
$video->convert($_GET['id'],$_GET['part']);
}
?>