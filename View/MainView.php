<?php 
	global $Utils, $Strings;
	$Utils->Trace('View::MainView: Showing main view'); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>MvC PHP Example Page</title>
	<link rel="stylesheet" type="text/css" media="screen" 
		href="<?= INSTALL_PATH ?>/View/Style/Default.css" />
		
	<script type="text/javascript" src="<?= INSTALL_PATH ?>/View/Javascript/Sortie.js"></script>
	<script type="text/javascript" src="<?= INSTALL_PATH ?>/View/Javascript/json.js"></script>
	<script type="text/javascript" src="<?= INSTALL_PATH ?>/View/Javascript/jsval.js"></script>
</head>
<body>
	<div id="contents">
		<h1><?= $GLOBALS['STRING.MAIN.TITLE'] ?></h1>
	
		<p><?php $Utils->ShowView($GLOBALS['PATH.MAIN.VIEW']) ?></p>
		
		<p>
		<a href="<?= $Utils->CreateLink('Example',$GLOBALS['METHOD.LINK']); ?>"><?= $GLOBALS['STRING.MAIN.LINK'] ?></a><br/>
		<a href="<?= $Utils->CreateLink('Example','Remote'); ?>">JSON <?= $Strings->Get('example') ?></a>
		</p>
	</div>
</body>
</html>
