<?php
	//	+=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-+
	//	| $GLOBALS[...]                                                       |
	//	+====================================================================+
	//	| CONTROLLER                     | The Controller to use             |
	//	+--------------------------------------------------------------------+
	//	| METHOD                         | The Method to run                 |
	//	+--------------------------------------------------------------------+
	//	| VIEW                           | The view file to uses             |
	//	+--------------------------------------------------------------------+
	//	| ERRORS                         | Array of request errors           |
	//	+====================================================================+
	
	$APP_DEBUG = true;
	$APP_STATE = "development";
	
	$INDEX_PAGE = "index";
	//the file extension of the m v c files
	$FILE_EXT = ".php";
	//The directory where this application is installed / if on the root, /myapp, etc
	$INSTALL_PATH = str_replace( ("/" . $INDEX_PAGE . $FILE_EXT), "", $_SERVER["SCRIPT_NAME"] );
	$SERVER_INSTALL_PATH = str_replace( ("/" . $INDEX_PAGE . $FILE_EXT),"", $_SERVER["SCRIPT_FILENAME"]);
	
	//the delimiter for the CONTROLLER/METHOD parameter passed in the url
	//for example index.asp?C=testcontroller.dosomething
	$C_M_Delimiter = ":";
	//The url variable that has the controller / method
	$URL_COMMAND_VAR = "c";
	
	////////////////////////////////////////////////////////////////////////////////////////
	//The default controller "page"
	$CONTROLLER = "Example";
	//The default method
	$METHOD = "DoIt";
	//The default view
	$VIEW = "MainView";
	
	//The default error view
	$ERROR_VIEW = "DefaultError";
	
	if($APP_STATE == "development") {
		$DB_USER="";
		$DB_PASS="";
		$DB_NAME="";
		$DB_HOST="";
	} else {
		$DB_USER="";
		$DB_PASS="";
		$DB_NAME="";
		$DB_HOST="";
	}
	////////////////////////////////////////////////////////////////////////////////////////
	
	$LINK_PATH = $INSTALL_PATH . "/" . $INDEX_PAGE . $FILE_EXT . "?" . $URL_COMMAND_VAR . "=";
	$LINK_DELIM = $C_M_Delimiter;
		
	////////////////////////////////////////////////////////////////////////////////////////
	$ERRORS = array();
?>