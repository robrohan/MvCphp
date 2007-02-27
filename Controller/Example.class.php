<?php 
	include_once("Model/Users.class.php");
	include_once("Libs/xmlrpc/xmlrpc.inc");
	include_once("Libs/jsonrpc/jsonrpc.inc");
	include_once("Libs/jsonrpc/json_extension_api.inc");
	
	/**
	 * Class: Example
	 * This is an example class to show the flow though the application. Any function
	 * defined in this class can be called though the URL by using the convention
	 * http://site.com/OBJECT/METHOD
	 */
	class Example {
		
		function Welcome() {
			$user = new Users();
			$user->GetUser(3);
			
			//in reality, this would be more in the view and probably
			//just the username would get passed in the GLOBALS
			//variable, but this is just a demo eh :)
			$GLOBALS["STRING.MAIN.TITLE"] = "Welcome " . $user->username;
			$GLOBALS["PATH.MAIN.VIEW"] = "GettingStarted";
			
			$GLOBALS["STRING.MAIN.LINK"] = "About";
			$GLOBALS["METHOD.LINK"] = "About";
		}
			
		function About(){
			$GLOBALS["STRING.MAIN.TITLE"] = "About";
			$GLOBALS["PATH.MAIN.VIEW"] = "About";
			
			$GLOBALS["STRING.MAIN.LINK"] = "Welcome";
			$GLOBALS["METHOD.LINK"] = "Welcome";
		}
		
		function Remote() {
			$testarry = array();
			$testarry["test"] = "Test";
			
			//write out a JSON encoded array
			$GLOBALS["JSON.RESPONSE"] = json_encode($testarry);
			//use the JSON template (minimal with headers set)
			$GLOBALS["VIEW"] = "JSON";
			//we also need to make sure debug is off because this is a 
			//raw transmission, so force off debug
			$GLOBALS["APP_DEBUG"] = "false";
		}
		
	}
?>