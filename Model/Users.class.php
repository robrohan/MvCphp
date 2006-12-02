<?php 
	include_once("Model/db/DataObject.class.php");
	
	class Users extends DataObject {
		
		function GetUser($id=1) {
			//pretend we do some cool select here and then attach using
			//the database results we attach the database fields to this
			//object.
			
			//$qry = "select * from Users where id = " . $this->CleanEntry($id);
			//$recordset = $this->GetQuery($qry);
			//$this->__ResultSetToAttributes($recordset);
			$this->username = "Rob";
			$this->id = 3;
		}
		
	}
?>