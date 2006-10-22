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
	//	+--------------------------------------------------------------------+
	//	| QUERIES                        | If using DataLayer - all queries  |
	//	+--------------------------------------------------------------------+
	//	| TRACE                          | Utils-Trace() - for tracing       |
	//	+====================================================================+
	
	//Sets the application debug state. If set to true will show debug 
	// information on the rendered page
	$APP_DEBUG = true;
	//Used to switch between application states (database connection, debug 
	// level, etc)
	$APP_STATE = "development";
	//Use friendly URLs using apache's mod_rewrite (see the .htaccess file). In 
	// a nut shell this makes urls look like
	// http://site.com/Controller/Method/?param1=value&param2=value instead of 
	// http://site.com/index.php?c=Controller:Method&param1=value&param2=value. 
	// You shouldn't have to change any code to swap between these, but it is 
	// imperative to use the $Utils->CreateLink() method for *all* Controller 
	// based actions, and prefix CSS and JS paths with $GLOBALS["INSTALL_PATH"]
	$USING_REWRITE = false;
	
	//Default page name to use as the main control page
	$INDEX_PAGE = "index";
	//The file extension of the m v c files as well as the main page, if you
	// change this be sure to look at the .htaccess file as well
	$FILE_EXT = ".php";
	//The directory where this application is installed / if on the root, 
	// /myapp, etc
	$INSTALL_PATH = str_replace( ("/" . $INDEX_PAGE . $FILE_EXT), "", $_SERVER["SCRIPT_NAME"] );
	$SERVER_INSTALL_PATH = str_replace( ("/" . $INDEX_PAGE . $FILE_EXT),"", $_SERVER["SCRIPT_FILENAME"]);
	
	//The delimiter for the CONTROLLER/METHOD parameter passed in the url
	// for example the : in index.asp?c=testcontroller:dosomething
	// if you change this be sure to look at the .htaccess file as well
	$C_M_Delimiter = ":";
	//The url variable that has the controller / method
	// if you change this be sure to look at the .htaccess file as well
	$URL_COMMAND_VAR = "c";
	
	////////////////////////////////////////////////////////////////////////////
	//The default controller "page". Set this to what contoller you want hit 
	// when they just go to http://yoursite.com
	$CONTROLLER = "Example";
	//The default method. Set this to what method you want hit when they just 
	//  go to http://yoursite.com
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
		//turn on all system error reporting (set to E_ALL for everything)
		error_reporting(E_USER_WARNING);
	} else {
		$DB_USER="";
		$DB_PASS="";
		$DB_NAME="";
		$DB_HOST="";
		//turn off all system error reporting
		error_reporting(0);
	}
	////////////////////////////////////////////////////////////////////////////
	
	$LINK_PATH = $INSTALL_PATH . "/" . $INDEX_PAGE . $FILE_EXT . "?" . $URL_COMMAND_VAR . "=";
	$LINK_DELIM = $C_M_Delimiter;
		
	////////////////////////////////////////////////////////////////////////////
	$ERRORS = array();
	$QUERIES = array();
	$TRACE = array();
?>