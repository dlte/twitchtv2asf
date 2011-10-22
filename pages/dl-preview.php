<?php if($_GET['filename']):?>
<div id="dl-preview" style="background-image: url(<?php echo $_GET['filename']?>.jpg);width:1018px:">
	<span class="title done">Done converting<br/><?php echo str_replace('converted/','',$_GET['filename'])?>.asf!</span>
	<span class="title size">Size: <?php echo round((filesize('../'.$_GET['filename'].'.asf')/1024)/1024)?>mb</span>
	<span class="title"><a href="<?php echo $_GET['filename'].'.asf'?>">download</a></span>
</div>
<?php endif;?>