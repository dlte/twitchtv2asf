<?php
require_once '../lib/class.video.php';
$user = $_COOKIE['user'];
$videos = new Video;
echo $videos->listRecordings($user);
?>