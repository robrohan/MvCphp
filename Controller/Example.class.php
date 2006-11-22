<?php 
	include_once("Model/Users.class.php");
	
	class Example {
		function DoIt() {
			$user = new Users();
			$user->Get(3);
			
			print_r( $user->username );
			
			$GLOBALS["TEST"] = "hello";
		}
			
		function DoItAgain(){
			$GLOBALS["TEST"] = "hello there";
		}
	}
?>