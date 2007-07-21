<?php
	/**
	 * File: Model/DataBase/DataLayer.class.php
	 * 	Part of the framework database access. You should never need to use this
	 * file directly.
	 *
	 * Copyright:
	 * 	2007 robrohan (rob.rohan@yahoo.com)
	 */

	/**
	 * Class: DataLayer
	 * A lot of this class was from the book teach yourself PHP in 
	 * 10 minutes.  It's a class that is _used_ by DataObject to provide
	 * access to a database. You should never need to use this class directly.
	 */
	class MySQLLayer {
		var $link;
		var $errors = array();
		var $debug = false;
	
		function MySQLLayer(){;}
		
		/**
		 * Function: Connect
		 * 	Connect to a mysql database
		 * 
		 * Parameters:
		 * 	host - The host to connect to
		 *  name - the user name used with the connection
		 *  pass - the password for the connection
		 *  db - the database to connect to
		 * Returns:
		 * 	
		 */
		function Connect($host, $name, $pass, $db) {
			$GLOBALS['Utils']->Trace('Model::DataLayer: Connecting to database ' . $db);
			
			$link = mysql_connect($host, $name, $pass);
			if(!$link){
				$this->SetError('Couldn\'t connect to database server');
				return false;
			}
		
			$this->link = $link;
		
			if(!mysql_select_db($db, $this->link)) {
				$this->SetError('Couldn\'t select the database: ' . $db);
				return false;
			}
		
			return true;
		}
	
		function GetError(){
			return $this->errors[count($this->errors)-1];
		}
	
		function SetError($str){
			$GLOBALS['Utils']->Trace('Model::DataLayer: ' . $str);
			array_push($this->errors, $str);
		}
		
		/**
		 * Function: __query
		 * 	Interal function used to perform the query
		 * 
		 * Parameters:
		 * 	query - the query to perfrom
		 *
		 * Returns:
		 * 	the result pointer
		 */
		function __query($query){
			if($GLOBALS['APP_DEBUG']){
				array_push($GLOBALS['QUERIES'], ''.$query);
			}
			
			if(!$this->link){
				$this->SetError('No active db connection');
				return false;
			}
			
			if($GLOBALS['APP_DEBUG'])
				$qstart = $GLOBALS['Utils']->TimingTime();
			
			$result = mysql_query($query, $this->link);
			
			if($GLOBALS['APP_DEBUG']) {
				$qend = $GLOBALS['Utils']->TimingTime();
				array_push($GLOBALS['QUERIES_TIME'], (round(($qend - $qstart)* 1000) / 1000) );
			}
			
			if(!$result)
				$this->SetError('error: ' . mysql_error());
		
			return $result;
		}
		
		/**
		 * Function: SetQuery
		 *  Perform a set query operation; often insert or update
		 * 
		 * Parameters:
		 * 	query - the query to perform
		 *
		 * Returns:
		 *  the new id if an insert, the number of effected rows if
		 * an update	
		 */	
		function SetQuery($query){
			if(!$results = $this->__query($query))
				return false;
		
			$newid = mysql_insert_id($this->link);
		
			if($newid){
				return $newid;
			} else {
				return mysql_affected_rows($this->link);
			}
		}
	
		function GetQuery($query){
			if(!$results = $this->__query($query))
				return false;
		
			$ret = array();
		
			while($row = mysql_fetch_assoc($results))
				$ret[] = $row;
			
			return $ret;
		}
	}
?>