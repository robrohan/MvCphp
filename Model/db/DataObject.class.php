<?php
	include_once("DataLayer.class.php");
	
	/**
	 * Class: DataObject
	 * Base class for database accessing
	 */
	class DataObject {
		var $layer;
		
		function Init() {
			if(!isset($this->layer)) {
				$this->layer = new DataLayer();
				$this->layer->Connect($GLOBALS["DB_HOST"], $GLOBALS["DB_USER"], $GLOBALS["DB_PASS"], $GLOBALS["DB_NAME"]);
			}			
		}
		
		function CleanEntry($strValue) {
			if(!empty($strValue)){
				return addslashes($strValue);
			}
		}
	}
?>