<?php 
	class Example {
		function DoIt() {
			$GLOBALS["Utils"]->Trace("Example::DoIt: Calling Example Controller");
			$GLOBALS["TEST"] = "hello";
		}
			
		function DoItAgain(){
			$GLOBALS["Utils"]->Trace("Example::DoItAgain: Calling Example Controller");
			$GLOBALS["TEST"] = "hello there";
		}
	}
?>