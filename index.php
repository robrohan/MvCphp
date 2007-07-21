<?php
	include_once('AppCore/Settings.php');
	include_once('AppCore/Utils.class.php');
	include_once('AppCore/Strings.class.php');
	
	//first break out the url variables
	$Utils->BreakoutContolMethod();
	
	//Run the controller if it exists
	$ControllerFile = (SERVER_INSTALL_PATH . '/Controller/' . $GLOBALS['CONTROLLER'] . '.class' . FILE_EXT);
	
	$Utils->Trace('Controller: ' . $ControllerFile);
	
	if($Utils->FileExists($ControllerFile)) {
		include_once($ControllerFile);
		
		$class_name =  $GLOBALS['CONTROLLER'];
		$method_name = $GLOBALS['METHOD'];
		
		//if the controller is in a sub direcotry, the controller variable
		//might have a / in it so we need to get that out
		if( strpos($GLOBALS['CONTROLLER'], '/') >= 0 ) {
			$cparts = explode('/',$GLOBALS['CONTROLLER']);
			$class_name = $cparts[(count($cparts)-1)];
		}
		
		if( class_exists($class_name) ) {
			$controller_obj = new $class_name();
			
			if( method_exists($controller_obj, $method_name) ){
				$Utils->Trace('Calling Controller: ' . $class_name . '::' . $method_name);
				call_user_func( array($controller_obj, $method_name) );
			} else {
				$Utils->AddError('Method "' . $method_name . '" is not defined on Controller "' . $class_name . '" (' . $ControllerFile . ')');
				$GLOBALS['VIEW'] = $GLOBALS['ERROR_VIEW'];
			}
		}
	} else {
		$Utils->AddError('Controller "' . $GLOBALS['CONTROLLER'] . '" is not defined (' . $ControllerFile . ')');
		$GLOBALS['VIEW'] = $GLOBALS['ERROR_VIEW'];
	}
	
	$Utils->ShowView($GLOBALS['VIEW']);
	
	if($APP_DEBUG) {
		include_once('AppCore/DumpDebug.php');
	}
?>