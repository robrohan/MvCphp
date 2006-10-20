<?php
	class ImplUtils {
		function MakeControlMethod() {
			return $GLOBALS["CONTROLLER"] . $GLOBALS["C_M_Delimiter"] . $GLOBALS["METHOD"];
		}
		
		function CreateLink($strController, $strMethod) {
			$linkpath = $GLOBALS["LINK_PATH"] . $strController . $GLOBALS["LINK_DELIM"] . $strMethod;
			return $linkpath;
		}
		
		function BreakoutContolMethod() {
			$strControlMethod = "";
			$aryControlMethod = array();
			
			if( isset($_GET[$GLOBALS["URL_COMMAND_VAR"]]) ) {
				$strControlMethod = $_GET[$GLOBALS["URL_COMMAND_VAR"]];
				
				$aryControlMethod = explode($GLOBALS["C_M_Delimiter"], $strControlMethod);
				
				if(count($aryControlMethod) > 0){
					if(!empty($aryControlMethod[0]))
						$GLOBALS["CONTROLLER"] = $aryControlMethod[0];
					if(count($aryControlMethod) >= 1){
						if(!empty($aryControlMethod[1]))
						$GLOBALS["METHOD"] = $aryControlMethod[1];
					}
				}
			}
			
		}
		
		function ShowView($strViewPath){
			if(!empty($strViewPath)) {
				$ViewFile = $GLOBALS["SERVER_INSTALL_PATH"] . "/View/" . $strViewPath . $GLOBALS["FILE_EXT"];
				
				if( $this->FileExists($ViewFile) ) {
					include($ViewFile);
				} else {
					$this->AddError("View '" . $GLOBALS["VIEW"] . "' is not defined (" . $ViewFile . ")");
					include( $GLOBALS["SERVER_INSTALL_PATH"] . "/View/" . $GLOBALS["ERROR_VIEW"] . $GLOBALS["FILE_EXT"] );
				}
			}
		}
		
		function FileExists($strFilepath) {
			return file_exists($strFilepath);
		}
				
		function AddError($strText) {
			array_push($GLOBALS["ERRORS"], $strText);
		}
		
		function HasErrors(){
			return count($GLOBALS["ERRORS"]);
		}
		
		function Trace($strItem) {
			if($GLOBALS["APP_DEBUG"])
				array_push($GLOBALS["TRACE"], $strItem);
		}
		
	}
	$Utils = new ImplUtils();
?>