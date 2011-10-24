# "Install" guide.
1. Change user and password in the .htpasswd file.
2. Change the path to the htpasswd file inside the htaccess file.
3. Download a static build of FFMPEG, can be found here: http://ffmpeg.zeranoe.com/builds/
4. Copy ffmpeg.exe to the same folder as index.php

# Optional settings.
If you want to convert your XSplit recordings into asf you will need to make a symbolic link to it inside the twitchtv2asf folder.

1. Start command via the start menu.
2. Go to the twitchtv2asf folder (cd c:\wamp\www\twitchtv2asf)
3. Make the link (mklink /J xsplit d:\fraps\xsplit\) !! The folder inside twitchtv2asf must be named xsplit in order to work !!

Thats it.

# Video tutorial.

<object width="560" height="315">
	<param name="movie" value="http://www.youtube.com/v/_PVExv3357U?version=3&amp;hl=en_US"></param>
	<param name="allowFullScreen" value="true"></param>
	<param name="allowscriptaccess" value="always"></param>
	<embed src="http://www.youtube.com/v/_PVExv3357U?version=3&amp;hl=en_US" type="application/x-shockwave-flash" width="560" height="315" allowscriptaccess="always" allowfullscreen="true"></embed>
</object>