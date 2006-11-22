<?php
	include_once("DataLayer.class.php");
	
	/**
	 * Class: DataObject
	 * Base class for database accessing
	 */
	class DataObject {
		var $layer;
		
		function DataObject($dblayer=>"") {
			if($dblayer == "") 
				$dblayer = new DataLayer();
			
			$this->layer = $dblayer;
			$this->layer->Connect($GLOBALS["DB_HOST"], $GLOBALS["DB_USER"], $GLOBALS["DB_PASS"], $GLOBALS["DB_NAME"]);
		}
		
		function CleanEntry($strValue) {
			if(!empty($strValue)){
				return addslashes($strValue);
			}
		}
	}
?>