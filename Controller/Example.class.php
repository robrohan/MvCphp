<?php 
	include_once("Model/User.class.php");
	
	class Example {
		function DoIt() {
			$user = new User();
			$user->Get(3)
			
			print_r( $user->username );
			
			$GLOBALS["TEST"] = "hello";
		}
			
		function DoItAgain(){
			$GLOBALS["TEST"] = "hello there";
		}
	}
?>