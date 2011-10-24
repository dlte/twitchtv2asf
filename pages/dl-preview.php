<?php 
error_reporting(E_ALL ^ E_NOTICE);
if($file=$_GET['filename']){
$file = preg_match('/xsplit/',$file) ? 'converted/'.str_replace('.flv_xsplit','',array_pop(explode('.flv_part',$file))):$file;
$filesize += sprintf("%u", @filesize('../'.$file.'.asf'));
$filesize = @round(($filesize/1024)/1024);
?>
<div id="dl-preview" style="background-image: url(<?php echo $file?>.jpg);width:1018px:">
	<span class="title done">Done converting<br/><?php echo str_replace('converted/','',$file)?>.asf!</span>
	<span class="title size">Size: <?php echo $filesize;?>mb</span>
	<span class="title"><a href="<?php echo $file.'.asf'?>">download</a></span>
</div>
<?php } ?>