<?php
	class DataLayer {
		var $link;
		var $errors = array();
		var $debug = false;
	
		function DataLayer(){;}
		
		function Connect($host, $name, $pass, $db) {
			$link = mysql_connect($host, $name, $pass);
			if(!$link){
				$this->setError("Couldn't connect to database server");
				return false;
			}
		
			$this->link = $link;
		
			if(!mysql_select_db($db, $this->link)) {
				$this->setError("Couldn't select the database: " . $db);
				return false;
			}
		
			return true;
		}
	
		function GetError(){
			return $this->errors[count($this->errors)-1];
		}
	
		function SetError($str){
			array_push($this->errors, $str);
		}
	
		function __query($query){
			if(!$this->link){
				$this->setError("No active db connection");
				return false;
			}
		
			$result = mysql_query($query, $this->link);
			if(!$result)
				$this->setError("error: " . mysql_error());
		
			return $result;
		}
	
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