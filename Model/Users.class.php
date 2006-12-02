<?php 
	include_once("Model/db/DataObject.class.php");
	
	class Users extends DataObject {
		
		function GetUser($id=1) {
			$qry = "select * from Users where id = " . $this->CleanEntry($id);
			$recordset = $this->GetQuery($qry);
			
			$this->__ResultSetToAttributes($recordset);
		}
		
	}
?>