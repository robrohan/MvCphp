<?php 
	include_once("Model/db/DataObject.class.php");
	
	class User extends DataObject {
		function TestExampe() {
			$qry="select * from Users";
			$rslt = $this->layer($qry);
			return $rslt;
		}
	}
?>