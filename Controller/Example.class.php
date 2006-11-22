<?php 
	class Example {
		function DoIt(){
			$GLOBALS["TEST"] = "hello";
		}
			
		function DoItAgain(){
			$GLOBALS["TEST"] = "hello there";
		}
	}
?>