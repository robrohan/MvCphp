<?php 
	include_once("Model/Users.class.php");
	
	/**
	 * Class: Example
	 * This is an example class to show the flow though the application. Any function
	 * defined in this class can be called though the URL by using the convention
	 * http://site.com/OBJECT/METHOD
	 */
	class Example {
		
		function DoIt() {
			$user = new Users();
			$user->GetUser(3);
			$GLOBALS["TEST"] = "hello " . $user->username . ". Your id is: " . $user->id;
		}
			
		function DoItAgain(){
			$GLOBALS["TEST"] = "hello there";
		}
		
	}
?>