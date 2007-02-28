<?php 
	include_once("Model/DataBase/DataObject.class.php");
	
	class Users /* extends DataObject */ {
		
		function GetUser($id=1) {
			//pretend we do some cool select here and then attach using
			//the database results we attach the database fields to this
			//object.
			
			//if I were really doing a query, I would extend the DataObject (
			//as seen above), and then go like this:
			
			//build a query
			//$qry = "select * from Users where id = " . $this->CleanEntry($id);
			
			//Get an array of results (see SetQuery for Insert and Update and what
			//they return)
			//$recordset = $this->GetQuery($qry);
			
			//this is optional and somwhat beta, what this does is take the results
			//of the recordset and attaches it to this instace of the object. So you
			//could access the database fields by doing $myinstance->my_db_column. You
			//by no meands have to do this and can just return the $recordset if you
			//wish.
			//$this->__ResultSetToAttributes($recordset);
			
			$this->username = "New User";
			$this->id = 3;
		}
		
	}
?>