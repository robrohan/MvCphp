<?php
	$Utils->Trace("Controller::Example: Calling Example Controller");
	
	switch($GLOBALS["METHOD"]){
		case "DoIt":
			$GLOBALS["TEST"] = "hello";
		break;
		
		case "DoItAgain":
			$GLOBALS["TEST"] = "hello there";
		break;
	}
?>