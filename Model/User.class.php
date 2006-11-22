<?php 
	include_once("Model/db/DataObject.class.php");
	
	class User extends DataObject {
		
		function TestExample() {
			$qry = "select * from Users";
			$rslt = $this->layer->GetQuery($qry);
			return $rslt;
		}
		
	}
?>