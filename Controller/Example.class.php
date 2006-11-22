<?php 
	include_once("Model/Users.class.php");
	
	class Example {
		
		function DoIt() {
			$user = new Users();
			$user->Get(3);
			
			$GLOBALS["TEST"] = "hello " . $user->username . " : " . $user->id;
		}
			
		function DoItAgain(){
			$GLOBALS["TEST"] = "hello there";
		}
		
	}
?>