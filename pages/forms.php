<?php
if($_POST['user']||$_GET['user']){
	$user=$_POST['user']?$_POST['user']:$_GET['user'];
	setcookie('user',$user,0,'/');
	if($_POST['user']) header('Location:'.$_SERVER["HTTP_REFERER"].'#recordings');
	else header('Location:/#recordings');
}
if($_POST['remove']=='yes'&&$_POST['file']){
	if(!preg_match('/[\/]/',$_POST['file'])){
		$fn=str_replace('.asf','',$_POST['file']);
		unlink('../converted/'.$fn.'.asf');
		unlink('../converted/'.$fn.'.jpg');
		echo 'removed';
	} else {
		echo 'not removed';
	}
}
?>