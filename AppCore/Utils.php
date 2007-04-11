<?php
	/**
	 * File: AppCore/Utils.php
	 *  Main framework functions file
	 *
	 * Copyright:
	 * 	2007 robrohan (rob.rohan@yahoo.com)
	 */

	/**
	 * Class: ImplUtils
	 * This is the implementation of the global Utils Object. Most framework
	 * functions are found in this class. You should never need to make an 
	 * instance of this class; it should already be avaiable in the global scope 
	 * and can be obtained by doing one of the following:
	 * (code)
	 * $GLOBALS["Utils"]
	 * global $Utils
	 * (end code)
	 * Methods you'll find interesting are marked as API true. While you can 
	 * access all of the methods in this object, not all will be useful for you 
	 * day to day.
	 */
	class ImplUtils {
		/**
		 * Function: MakeControlMethod
		 * Framework method to create the end of a URL from the current
		 * controller and method setting
		 */
		function MakeControlMethod() {
			return $GLOBALS['CONTROLLER'] . $GLOBALS['C_M_DELIMITER'] . $GLOBALS['METHOD'];
		}
		
		/**
		 * Function: CreateLink
		 *  Create a link to a controler and method suitable for use on a view
		 * page. The reason you'd  want to use this method is it will allow for
		 * toggling of the search engine friendly URLs. An example usage would
		 * be:
		 * (code)
		 * //in a view...
		 * <a href='<?= $GLOBALS["Utils"]->CreateLink("Controller","Method",array("myid"=>$somevariable,"another"=>"thisone")) ...
		 * (end code)
		 * 
		 * Parameters:
		 *  strController - the controller name to link to
		 *  strMethod - the method name to link to
		 *  aryparams - an associative array of url parameters to pass. For
		 *   example array(id=>"myvar",otherthing=>$value)
		 *
		 * Returns:
		 *  an href 'able link to another controller and method
		 *
		 * SeeAlso:
		 *  <JumpTo>
		 *
		 * API:
		 *  true
		 */
		function CreateLink($strController, $strMethod, $aryparams = array()) {
			return $this->__makeURL($strController, $strMethod, $aryparams);
		}
		
		/**
		 * Function: JumpTo
		 *  JumpTo is used from within a Controller to jump to another 
		 * Controller / Method. It branches the logic from from Controller / 
		 * Method to another. Similar to CreateLink but no one has to click the
		 * link. Example:
		 * (code)
		 * //in a controller...
		 * if(!loggedIn)
		 * 	$GLOBALS["Utils"]->JumpTo("Main","Login",array("another"=>"thisone"));
		 * else
		 *  $GLOBALS["Utils"]->JumpTo("Admin","MainMenu");
		 * (end code)
		 * 
		 * Parameters:
		 * 	strController - the controller name to link to
		 *  strMethod - the method name to link to
		 *  aryparams - an associative array of url parameters to pass. For
		 *   example array(id=>"myvar",otherthing=>$value)
		 *
		 * SeeAlso:
		 *  <CreateLink>
		 * 	
		 * API:
		 *  true
		 */
		function JumpTo($strController, $strMethod, $aryparams = array()){
			header('Location: ' . $this->__makeURL($strController, $strMethod, $aryparams));
			exit;
		}
		
		/**
		 * Helper function for CreateLink and JumpTo
		 */
		function __makeURL($strController, $strMethod, $aryparams){
			$urlparams = "";
			
			if($GLOBALS['USING_REWRITE']) {
				//in the end this will look like http://blarg.com/Controller/Method/?param1=value&param2=value
				if(count($aryparams)){
					$urlparams = '?';
					foreach($aryparams as $name=>$value){
						$urlparams .= $name . '=' . urlencode($value) . '&';
					}
					$urlparams = substr($urlparams,0,strlen($urlparams)-1);
				}
				
				$linkpath = $GLOBALS['INSTALL_PATH'] . '/' . $strController . '/' . $strMethod . '/' . $urlparams;
			} else {
				//in the end this will look like http://blarg.com/index.php?c=Controller:Method&param1=value&param2=value
				if(count($aryparams)){
					foreach($aryparams as $name=>$value){
						$urlparams .= '&' . $name . '=' . urlencode($value);
					}
				}
				
				$linkpath = $GLOBALS['LINK_PATH'] . $strController . $GLOBALS['LINK_DELIM'] . $strMethod . $urlparams;
			}
			return $linkpath;
		}
		
		/**
		 * Break out the controller and method portions of the url
		 */
		function BreakoutContolMethod() {
			$strControlMethod = '';
			$aryControlMethod = array();
			
			if( isset($_GET[$GLOBALS['URL_COMMAND_VAR']]) ) {
				$strControlMethod = $_GET[$GLOBALS['URL_COMMAND_VAR']];
				
				$aryControlMethod = explode($GLOBALS['C_M_DELIMITER'], $strControlMethod);
				
				$clen = count($aryControlMethod);
				if($clen > 0){
					$GLOBALS['CONTROLLER'] = '';
					$GLOBALS['METHOD'] = '';
					
					for($i = 0; $i < $clen; $i++) {
						if($i == ($clen-1)){
							$GLOBALS['METHOD'] = $aryControlMethod[$i];
						} else {
							$GLOBALS['CONTROLLER'] .= $aryControlMethod[$i] . "/";
						}
					}
					
					//remove the last / on the controller
					$GLOBALS['CONTROLLER'] = substr($GLOBALS['CONTROLLER'], 0, (strlen($GLOBALS['CONTROLLER'])-1) );
				}
			}
			
		}
		
		/**
		 * Function: ShowView
		 * 	Includes, at the point it is called, another view page from within
		 * the View direcotry. This is used to build a set of tiles or pods on
		 * the MainView. 
		 * For example, the left side of the main view could be
		 * the main navigaion - the navigation could be in it's own file and then
		 * this is used to inlcude it. 
		 * The strViewPath is often a variable set by a controller so the area
		 * of the page can change
		 * Example:
		 * (code)
		 * ...
		 * <div class="mainToolbar"><?php $GLOBALS["Utils"]->ShowView($GLOBALS["MAIN.VIEW"]); ...
		 * <div><?php $GLOBALS["Utils"]->ShowView($GLOBALS["MAIN.SIDE1"]); ...
		 * <div class="mainRightSide"><?php $GLOBALS["Utils"]->ShowView($GLOBALS["MAIN.SIDE2"]); ...
		 * ...
		 * (end code)
		 * 
		 * Parameters:
		 * 	strViewPath - the view to show. This must be within the View 
		 *   directory and should *not* end with ".php"
		 *
		 * API:
		 *  true
		 */
		function ShowView($strViewPath){
			if(!empty($strViewPath)) {
				$ViewFile = $GLOBALS['SERVER_INSTALL_PATH'] . '/View/' . $strViewPath . $GLOBALS['FILE_EXT'];
				
				if( $this->FileExists($ViewFile) ) {
					include($ViewFile);
				} else {
					$this->AddError('View "' . $GLOBALS['VIEW'] . '" is not defined (' . $ViewFile . ')');
					include( $GLOBALS['SERVER_INSTALL_PATH'] . '/View/' . $GLOBALS['ERROR_VIEW'] . $GLOBALS['FILE_EXT'] );
				}
			}
		}
		
		/**
		 * Function: TimingTime
		 * 	Time used to time code execution; for example a query time. Often used
		 * like the following:
		 * (code)
		 * $start = $Utils->TimingTime();
		 * ... something ...
		 * echo "It took: " . ($Utils->TimingTime() - $start) . "ms";
		 * (end code)
		 * 
		 * Returns:
		 * 	the current time in milliseconds
		 *
		 * API:
		 *  true
		 */
		function TimingTime(){
			$mtime = microtime();
			$mtime = explode(" ",$mtime);
			$mtime = $mtime[1] + $mtime[0];
			return $mtime * 1000;
		}
		
		/**
		 * Function: FileExists
		 * 	Checks to see if a file exists. This just abstracts the file_exists
		 * function to allow for API compatibility between the ASP and PHP
		 * versions
		 * 
		 * Parameters:
		 * 	strFilepath - the file to check for existance
		 *
		 * Returns:
		 * 	true, if the file exists false otherwise
		 *
		 * API:
		 *  true
		 */
		function FileExists($strFilepath) {
			return file_exists($strFilepath);
		}
		
		/**
		 * Function: AddError
		 * 	Add a processing error (for display on the error page). One can also
		 * simply loop over the global ERRORS array and show these errors as
		 * part of the application - invalid field error for example
		 * 
		 * Parameters:
		 * 	strText - the text for the error (to display on the error page)
		 *
		 * SeeAlso:
		 *  <ERRORS>
		 *
		 * API:
		 *  true
		 */
		function AddError($strText) {
			array_push($GLOBALS['ERRORS'], $strText);
		}
		
		/**
		 * Function: HasErrors
		 * 	Simple method to see if there are errors in the gloabl error array.
		 * This method is mostly for compatibility with the ASP version.
		 * 
		 * Returns:
		 * 	true if there are errors in the error array
		 *
		 * SeeAlso:
		 *  <ERRORS>
		 *
		 * API:
		 *  true
		 */
		function HasErrors(){
			return count($GLOBALS['ERRORS']);
		}
		
		/**
		 * Function: Trace
		 * 	When debug is on, shows a trace in the debug section on the page.
		 * This is useful when trying to figure out how variables change though
		 * out the request, and general debugging.
		 * 
		 * Parameters:
		 * 	strItem - the text to display on the trace output
		 *
		 * SeeAlso:
		 *  <TRACE>
		 *
		 * API:
		 *  true
		 */
		function Trace($strItem) {
			if($GLOBALS['APP_DEBUG'])
				array_push($GLOBALS['TRACE'], $strItem);
		}
	}
	
	/**
	 * Variable: Utils
	 * 	This is the implementation of ImplUtils one should use while using the
	 * framework.
	 * 
	 * SeeAlso:
	 *  <ImplUtils>
	 *
	 * Global:
	 *  true
	 */
	$Utils = new ImplUtils();
?>