<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>twitch.tv2asf</title>
<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script src="js/js.js"></script>
</head>
<body>
<div id="container">
<div id="logo"></div>
<div id="search">
<form method="post" action="pages/forms.php">
<input type="text" name="user" placeholder="User" style="float:left">
</form>
</div>
<div class="clearer"></div>
<div style="width:1024px;display:block;color:white;">
	<div id="progressbar-container">
		<div id="progress-percent" class="left"></div><div id="progress-seconds" class="right"></div>
		<div id="progressbar"></div>
		<div class="clearer"></div>
		<div id="dl-preview-container"></div>
		<div class="clearer"></div>
	</div>
	<div id="link" class="left"></div>
</div>
<div style="clear:both;"></div>
<h1 page="converted.php" id="converted">Converted</h1> 
<?php if(is_dir("xsplit")):?>
<h1 page="xsplit.php" id="xsplit">XSplit</h1>
<?php endif;?>
<?php if(@$_COOKIE['user']):?>
<h1 page="recordings.php" id="recordings">Twitch.tv</h1>
<?php endif;?>
<div id="list"><?php include "converted.php";?></div>
<div id="footer">Made by delete 2011 (<a href="mailto:manellermus[at]gmail.com">email</a>/<a href="http://www.twitch.tv/ulph">Twitch</a>)</div>
</div>
</body>
</html>