<?php
	include_once("Model/db/DataLayer.class.php");
	
	$GLOBALS["dblayer"] = "";
	
	/**
	 * Class: DataObject
	 * Base class for database accessing
	 */
	class DataObject {
		var $layer;
		
		/**
		 * Method: DataObject
		 * Creates a new DataObject, and connects the object to the database.
		 * 
		 * Note:
		 * 	I am not sure how well this would work on a multi processor system. Since
		 *	the whole request (and all objects within the request) share the same db
		 * 	connection, if php splits these over 2 or more processors they db request
		 *	might collide
		 */
		function DataObject() {
			global dblayer;
			
			if($dblayer == "") {
				$dblayer = new DataLayer();
				
				$dblayer->Connect($GLOBALS["DB_HOST"], $GLOBALS["DB_USER"], $GLOBALS["DB_PASS"], $GLOBALS["DB_NAME"]);
				$this->layer = @$dblayer;
			}
		}
		
		function CleanEntry($strValue) {
			if(!empty($strValue)){
				return addslashes($strValue);
			}
		}
		
		function Get($id=1) {
			$qry = "select * from " . get_class($this) . " where id=" . $this->CleanEntry($id);
			$rslt = $this->layer->GetQuery($qry);
			
			foreach($rslt as $row){
				foreach($row as $name=>$value) {
					$this->$name = $value;
					//array_push($this,$name,$field);
				}
			}
			
			return $rslt;
		}
		
	}
?>