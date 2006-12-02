<?php
	include_once("Model/db/DataLayer.class.php");
	
	$GLOBALS["dblayer"] = "";
	
	/**
	 * Class: DataObject
	 * Base class for database access. Model objects can extend this
	 * class to automagically get access to the database. Something like
	 * this:
	 * (code)
	 *  include_once("Model/db/DataObject.class.php");
	 *  class Users extends DataObject {
	 *	
	 *	}
	 * (end code)
	 * Doing so will allow you to make calls to the database from within function.
	 * The main methods you'll use will probably be
	 * (code)
	 * 	...
	 *	 $result = $this->GetQuery("select foo from bar where x = 12");
	 *	 $newid = $this->SetQuery("insert into foo (bar) values ('foobar')");
	 *   $numrecs = $this->SetQuery("update foo set bar = 'foobar'");
	 * 	...
	 * (end code)
	 * See the methods GetQuery and SetQuery for more information
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
		 * Function: CleanEntry
		 * For inserts and updates. Attempts to keep nasties from messing up SQL queries. 
		 * It's a good idea to call this for every field in an insert or update - that way
		 * you can enhance the function if need be.
		 * 
		 * Parameters:
		 * 	strValue - a value to clean
		 *
		 * Returns:
		 *  the cleaned value ready to go into the database.	
		 */
		function CleanEntry($strValue) {
			if(!empty($strValue)){
				return addslashes($strValue);
			}
		}
		
		/**
		 * Function: GetQuery
		 * Runs a raw GetQuery (select query) and returns a recordset (an array
		 * of arrays)
		 * 
		 * Parameters:
		 * 	sql - the query to run (should be a select query)
		 *
		 * Returns:
		 * 	restuls as a recordset
		 */
		function GetQuery($sql) {
			$rslt = $this->layer->GetQuery($sql);
			return $rslt;
		}
		
		/**
		 * Function: SetQuery
		 * 	Run a setting query (an insert or an update)
		 * 
		 * Parameters:
		 * 	sql - the insert of the update query
		 *
		 * Returns:
		 *  if an insert, will return the new records id, on an update
		 * 	the number of effected rows 	
		 */
		function SetQuery($sql) {
			$rslt = $this->layer->SetQuery($sql);
			return $rslt;
		}
		
		///////////////////////////////////////////////////////////////////////////////
		// This is the beginnings of a RoR ActiveRecord kind of thing. Kind of raw, and
		// I don't think it's really a good idea to do this in PHP. In the end, I think
		// if you want something like RoR, just use RoR. But if you want to carry on this
		// would be a brute force way to do it. You can delete the rest of the functions
		// in this file if you don't want to try to implement this
		
		/**
		 * Get an item by the id field
		 */
		function Get($id=1) {
			$this->FindByQuery("where id=" . $this->CleanEntry($id));
		}
		
		function Store() {
			// could just loop over this objects properties and try to store the values
			// but would need someway of marking them as coming from the table
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
			$qry = "select * from " . ucwords(get_class($this)) . $fragment;
			$rslt = $this->GetQuery($qry);
			$this->__ResultSetToAttributes($rslt);
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