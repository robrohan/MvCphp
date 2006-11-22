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
			global $dblayer;
			
			if($dblayer == "") {
				$dblayer = new DataLayer();
				
				$dblayer->Connect($GLOBALS["DB_HOST"], $GLOBALS["DB_USER"], $GLOBALS["DB_PASS"], $GLOBALS["DB_NAME"]);
				$this->layer = @$dblayer;
			}
		}
		
		/**
		 * For inserts and updates. Attempts to keep nasties from messing up SQL queries
		 */
		function CleanEntry($strValue) {
			if(!empty($strValue)){
				return addslashes($strValue);
			}
		}
		
		/**
		 * Get an item by the id field
		 */
		function Get($id=1) {
			$qry = "select * from " . get_class($this) . " where id=" . $this->CleanEntry($id);
			$rslt = $this->layer->GetQuery($qry);
			__ResultSetToAttributes($rslt);
		}
		
		/**
		 * Get an item using and SQL fragment. The SQL parameter should start from after the from 
		 * clause. So a valid paramenter for this method could be "where x = 12 and z = 34", or
		 * "join x on b.id = x.id where z = 12"
		 *
		 * Note:
		 * 	this doesn't protect you from writing something that returns more than one record. in
		 * 	that event this object will hold the last item in the result set
		 */
		function FindByQuery($fragment) {
			$qry = "select * from " . get_class($this) . $fragment;
			$rslt = $this->layer->GetQuery($qry);
			__ResultSetToAttributes($rslt);
		}
		
		function __ResultSetToAttributes($rslt) {
			foreach($rslt as $row){
				foreach($row as $name=>$value) {
					$this->$name = $value;
				}
			}
		}
	}
?>