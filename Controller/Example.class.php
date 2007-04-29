<?php 
	include_once('Model/Users.class.php');
	//note these are using simlinks to the actual libraries, if you
	//are using an OS that doesn't support simlinks (windows?) then you can
	//change these paths to the full path, for example: xmlrpc-2.1 instead of xmlrpc
	include_once('Libs/xmlrpc/xmlrpc.inc');
	include_once('Libs/jsonrpc/jsonrpc.inc');
	include_once('Libs/jsonrpc/json_extension_api.inc');
	
	/**
	 * Class: Example
	 * This is an example class to show the flow though the application. Any function
	 * defined in this class can be called though the URL by using the convention
	 * http://site.com/OBJECT/METHOD
	 */
	class Example {
		/**
		 * Function: Welcome
		 * 	Shows a simple welcome screen
		 */
		function Welcome() {
			global $Strings;
			
			$user = new Users();
			$user->GetUser(3);
			
			//in reality, this would be more in the view and probably
			//just the username would get passed in the GLOBALS
			//variable, but this is just a demo eh :)
			$GLOBALS['STRING.MAIN.TITLE'] = $Strings->Get('welcome', '?welcome?', array($user->username));
			$GLOBALS['PATH.MAIN.VIEW'] = 'GettingStarted';
			
			$GLOBALS['STRING.MAIN.LINK'] = $Strings->Get('about');
			$GLOBALS['METHOD.LINK'] = 'About';
		}
		
		/**
		 * Function: About
		 * Shows a simple about screen
		 */
		function About() {
			global $Strings;
			$GLOBALS['STRING.MAIN.TITLE'] = $Strings->Get('about');
			$GLOBALS['PATH.MAIN.VIEW'] = 'About';
			
			$GLOBALS['STRING.MAIN.LINK'] = $Strings->Get('welcome');
			$GLOBALS['METHOD.LINK'] = 'Welcome';
		}
		
		/**
		 * Function: Remote
		 * Demo method of using JSON for remote ajax calls
		 * 	
		 * Returns:
		 * 	A remote array
		 */
		function Remote() {
			$testarry = array();
			$testarry['test'] = 'Test';
			
			//write out a JSON encoded array
			$GLOBALS['JSON.RESPONSE'] = json_encode($testarry);
			//use the JSON template (minimal with headers set)
			$GLOBALS['VIEW'] = 'JSON';
			//we also need to make sure debug is off because this is a 
			//raw transmission, so force off debug
			$GLOBALS['APP_DEBUG'] = false;
		}
		
	}
?>