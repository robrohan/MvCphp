<link rel="stylesheet" type="text/css" href="<?= INSTALL_PATH ?>/AppCore/Debug.css" />
<div id="mvcphp_debug">
	
<p><strong>Util->Trace</strong></p>
<?php
if( count($GLOBALS['TRACE']) ){
	print('<pre>');
	foreach($GLOBALS['TRACE'] as $tracestep){
		print($tracestep . '<br>');
	}
	print('</pre>');
}
?>
	
<p><strong>APP_STATE</strong>: <strong><?= APP_STATE ?></strong></p>
<p><strong>Controller</strong>: <?= $GLOBALS['CONTROLLER'] ?></p>
<p><strong>Method</strong>: <?= $GLOBALS['METHOD'] ?></p>
<p><strong>View</strong>: <?= $GLOBALS['VIEW'] ?></p>
	
<p><strong>INSTALL_PATH</strong>: <?= INSTALL_PATH ?></p>
<p><strong>SERVER_INSTALL_PATH</strong>: <?= SERVER_INSTALL_PATH ?></p>
<p><strong>LINK_PATH</strong>: <?= LINK_PATH ?></p>
<hr/>
	
<p><strong>Database Settings</strong></p>
<p><strong>DB_USER</strong>: <strong><?= DB_USER ?></strong></p>
<p><strong>DB_PASS</strong>: <strong><?= DB_PASS ?></strong></p>
<p><strong>DB_NAME</strong>: <strong><?= DB_NAME ?></strong></p>
<p><strong>DB_HOST</strong>: <strong><?= DB_HOST ?></strong></p>
<hr/>
	
<p><strong>Queries</strong></p>
<?php
if( count($GLOBALS['QUERIES']) ){
	foreach($GLOBALS['QUERIES'] as $k=>$dtquery) {
		print('<br>');
		print('Time: ' . $GLOBALS['QUERIES_TIME'][$k] . 'ms');
		print('<br>');
		print('<pre>');
			print($dtquery);
		print('</pre>');
	}
}
?>
	
<hr/>

<p><strong>_POST</strong></p>
<?php
if( !empty($_POST) ){
	print('<pre>');
		print_r($_POST);
	print('</pre>');
}
?>
	
<hr/>
	
<p><strong>_GET</strong></p>
<?php
if( !empty($_GET) ){
	print('<pre>');
		print_r($_GET);
	print('</pre>');
}
?>

<hr/>

<?php
	foreach($_SERVER as $name => $value){
		print('<p><strong>' . $name . '</strong>: ' . $value . '</p>');
	}
?>
</div>