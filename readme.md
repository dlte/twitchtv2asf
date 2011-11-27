# "Install" guide.
1. Change user and password in the .htpasswd file.
2. Change the path to the htpasswd file inside the htaccess file. (if needed)
3. Download a static build of FFMPEG, can be found here: http://ffmpeg.zeranoe.com/builds/
4. Copy ffmpeg.exe to the same folder as index.php

# Optional settings.
If you want to convert your XSplit recordings into asf you will need to make a symbolic link to it inside the twitchtv2asf folder.

1. Open a command prompt.
2. Go to the twitchtv2asf folder (cd c:\wamp\www\twitchtv2asf)
3. Make the link (mklink /J xsplit d:\fraps\xsplit\) !! The folder inside twitchtv2asf must be named xsplit in order to work !!

Thats it.

# Video tutorial.

http://youtu.be/_PVExv3357U

# Current limitations

- Only windows support.
- Can only convert one file at a time.