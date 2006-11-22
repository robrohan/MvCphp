<?php 
	include_once("Model/User.class.php");
	
	class Example {
		function DoIt() {
			$user = new User();
			
			print_r($user->TestExample());
			
			$GLOBALS["TEST"] = "hello";
		}
			
		function DoItAgain(){
			$GLOBALS["TEST"] = "hello there";
		}
	}
?>