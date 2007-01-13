<?php 
	include_once("Model/Users.class.php");
	
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
		
	}
?>