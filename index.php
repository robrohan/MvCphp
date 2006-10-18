<?php
	include_once("AppCore/Settings.php");
	include_once("AppCore/Utils.php");
	
	//first break out the url variables
	$Utils->BreakoutContolMethod();
	
	//Run the controller if it exists
	$ControllerFile = ($GLOBALS["SERVER_INSTALL_PATH"] . "/Controller/" . $GLOBALS["CONTROLLER"] . $FILE_EXT);
	if($Utils->FileExists($ControllerFile)) {
		include($ControllerFile);
	} else {
		$Utils->AddError("Controller '" . $GLOBALS["CONTROLLER"] . "' is not defined (" . $ControllerFile . ")");
	}
	
	$Utils->ShowView($GLOBALS["VIEW"] . $FILE_EXT);
	
	if($APP_DEBUG) {
		print("<link rel='stylesheet' type='text/css' href='AppCore/Debug.css' />");
		print("<div id='mvcasp_debug'>");
		print("<p><strong>Controller</strong>: " . $GLOBALS["CONTROLLER"] . "</p>");
		print("<p><strong>Method</strong>: " . $GLOBALS["METHOD"] . "</p>");
		print("<p><strong>View</strong>: " . $GLOBALS["VIEW"] . "</p>");
		print("<hr/>");
		
		print("<p><strong>INSTALL_PATH</strong>: " . $GLOBALS["INSTALL_PATH"] . "</p>");
		print("<p><strong>SERVER_INSTALL_PATH</strong>: " . $GLOBALS["SERVER_INSTALL_PATH"] . "</p>");
		print("<p><strong>LINK_PATH</strong>: " . $GLOBALS["LINK_PATH"] . "</p>");
		
		foreach($_SERVER as $name => $value){
			print("<p><strong>" . $name . "</strong>: " . $value . "</p>");
		}
		
		print("</div>");
	}
?>