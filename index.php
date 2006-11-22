<?php
	include_once("AppCore/Settings.php");
	include_once("AppCore/Utils.php");
	
	//first break out the url variables
	$Utils->BreakoutContolMethod();
	
	//Run the controller if it exists
	$ControllerFile = ($GLOBALS["SERVER_INSTALL_PATH"] . "/Controller/" . $GLOBALS["CONTROLLER"] . ".class" . $FILE_EXT);
	
	if($Utils->FileExists($ControllerFile)) {
		include($ControllerFile);
		
		if( class_exists($GLOBALS["CONTROLLER"]) ) {
			$controller_obj = new $GLOBALS["CONTROLLER"]();
			
			if( method_exists($controller_obj, $GLOBALS["METHOD"]) ){
				$controller_obj->$GLOBALS["METHOD"];
			}
		}
		
	} else {
		$Utils->AddError("Controller '" . $GLOBALS["CONTROLLER"] . "' is not defined (" . $ControllerFile . ")");
	}
	
	$Utils->ShowView($GLOBALS["VIEW"]);
	
	if($APP_DEBUG) {
		print("<link rel='stylesheet' type='text/css' href='" . $GLOBALS["INSTALL_PATH"] ."/AppCore/Debug.css' />");
		print("<div id='mvcasp_debug'>");
		
		print("<p><strong>Util->Trace</strong></p>");
		if( count($GLOBALS["TRACE"]) ){
			print("<pre>");
			foreach($GLOBALS["TRACE"] as $tracestep){
				print($tracestep . "<br>");
			}
			print("</pre>");
		}
		
		print("<p><strong>APP_STATE</strong>: <strong>" . $GLOBALS["APP_STATE"] . "</strong></p>");
		print("<p><strong>Controller</strong>: " . $GLOBALS["CONTROLLER"] . "</p>");
		print("<p><strong>Method</strong>: " . $GLOBALS["METHOD"] . "</p>");
		print("<p><strong>View</strong>: " . $GLOBALS["VIEW"] . "</p>");
		
		print("<p><strong>INSTALL_PATH</strong>: " . $GLOBALS["INSTALL_PATH"] . "</p>");
		print("<p><strong>SERVER_INSTALL_PATH</strong>: " . $GLOBALS["SERVER_INSTALL_PATH"] . "</p>");
		print("<p><strong>LINK_PATH</strong>: " . $GLOBALS["LINK_PATH"] . "</p>");
		print("<hr/>");
		
		print("<p><strong>Database Settings</strong></p>");
		print("<p><strong>DB_USER</strong>: <strong>" . $GLOBALS["DB_USER"] . "</strong></p>");
		print("<p><strong>DB_PASS</strong>: <strong>" . $GLOBALS["DB_PASS"] . "</strong></p>");
		print("<p><strong>DB_NAME</strong>: <strong>" . $GLOBALS["DB_NAME"] . "</strong></p>");
		print("<p><strong>DB_HOST</strong>: <strong>" . $GLOBALS["DB_HOST"] . "</strong></p>");
		print("<hr/>");
		
		print("<p><strong>Queries</strong></p>");
		if( count($GLOBALS["QUERIES"]) ){
			foreach($GLOBALS["QUERIES"] as $dtquery){
				print("<pre>");
					print($dtquery);
				print("</pre>");
			}
		}
		
		print("<hr/>");

		print("<p><strong>_POST</strong></p>");
		if( !empty($_POST) ){
			print("<pre>");
				print_r($_POST);
			print("</pre>");
		}
		
		print("<hr/>");
		
		print("<p><strong>_GET</strong></p>");
		if( !empty($_GET) ){
			print("<pre>");
				print_r($_GET);
			print("</pre>");
		}
		
		print("<hr/>");
		
		foreach($_SERVER as $name => $value){
			print("<p><strong>" . $name . "</strong>: " . $value . "</p>");
		}
		
		print("</div>");
	}
?>