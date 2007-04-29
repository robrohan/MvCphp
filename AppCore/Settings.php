<?php
	/**
	 * File: AppCore/Settings.php
	 * 	This is the main configuration file for the framework. You'll likely
	 * want to set the database configuration information here (if your going
	 * to be using the DataObject). You can also turn on SEF URLs here (if you
	 * have mod_rewrite available in Apache) as well as the application state
	 * and debug mode.
	 *
	 * Copyright:
	 * 	2007 robrohan (rob.rohan@yahoo.com)
	 */

	//	+=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-+
	//	| $GLOBALS[...]                                                      |
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
	
	/**
	 * Variable: APP_DEBUG
	 * Sets the application debug state. If set to true will show debug 
	 * information on the rendered page
	 *
	 * Global: 
	 * 	true
	 */
	$APP_DEBUG = true;
	
	/**
	 * Variable: APP_STATE
	 * Used to switch between application states (database connection, debug 
	 * level, etc)
	 *
	 * Global:
	 *  true
	 */
	define('APP_STATE', 'development');
	
	/**
	 * Variable: USING_REWRITE
	 * Use friendly URLs using apache's mod_rewrite (see the .htaccess file). In 
	 * a nut shell this makes urls look like
	 * http://site.com/Controller/Method/?param1=value&param2=value instead of 
	 * http://site.com/index.php?c=Controller:Method&param1=value&param2=value. 
	 * You shouldn't have to change any code to swap between these, but it is 
	 * imperative to use the $Utils->CreateLink() method for *all* Controller 
	 * based actions, and prefix CSS and JS paths with $GLOBALS["INSTALL_PATH"]
	 */
	define('USING_REWRITE', false);
	
	/**
	 * Variable: INDEX_PAGE
	 * 	Default page name to use as the main control page
	 */
	define('INDEX_PAGE', 'index');
	
	/**
	 * Variable: FILE_EXT
	 * 	The file extension of the m v c files as well as the main page, if you
	 * change this be sure to look at the .htaccess file as well
	 */
	define('FILE_EXT', '.php');
	
	/**
	 * Variable: INSTALL_PATH
	 * 	the path to the root of the application from the browsers point of view 
	 * (information only)
	 * 
	 * Global:
	 *  true
	 */
	define('INSTALL_PATH', str_replace( ('/' . $INDEX_PAGE . $FILE_EXT), '', $_SERVER['SCRIPT_NAME'] ));
	//$INSTALL_PATH = str_replace( ('/' . $INDEX_PAGE . $FILE_EXT), '', $_SERVER['SCRIPT_NAME'] );
	
	/**
	 * Variable: SERVER_INSTALL_PATH
	 * the path to the root of the application from the server file system point 
	 * of view  (information only)
	 * 
	 * Global:
	 *  true
	 */
	define('SERVER_INSTALL_PATH', str_replace( ('/' . $INDEX_PAGE . $FILE_EXT),"", $_SERVER['SCRIPT_FILENAME']));
	//$SERVER_INSTALL_PATH = str_replace( ('/' . $INDEX_PAGE . $FILE_EXT),"", $_SERVER['SCRIPT_FILENAME']);
	
	/**
	 * Variable: C_M_DELIMITER
	 * The delimiter for the CONTROLLER/METHOD parameter passed in the url
	 * for example the : in index.asp?c=testcontroller:dosomething
	 * if you change this be sure to look at the .htaccess file as well
	 */
	//$C_M_DELIMITER = ':';
	define('C_M_DELIMITER', ':');
	
	/**
	 * Variable: URL_COMMAND_VAR
	 * The url variable that has the controller / method
	 * if you change this be sure to look at the .htaccess file as well
	 */
	//$URL_COMMAND_VAR = 'c';
	define('URL_COMMAND_VAR', 'c');
	
	////////////////////////////////////////////////////////////////////////////
	
	/**
	 * Variable: CONTROLLER
	 * The default controller "page". Set this to what contoller you want hit 
	 * when they just go to http://yoursite.com
	 * 
	 * Global:
	 *  true
	 */
	$CONTROLLER = 'Example';
	
	/**
	 * Variable: METHOD
	 * The default method. Set this to what method you want hit when they just
	 * go to http://yoursite.com
	 * 
	 * Global:
	 *  true
	 */
	$METHOD = 'Welcome';
	
	/**
	 * Variable: VIEW
	 * The default view
	 * 
	 * Global:
	 *  true
	 */
	$VIEW = 'MainView';
	
	/**
	 * Variable: ERROR_VIEW
	 * The default error view
	 * 
	 * Global:
	 *  true
	 */
	$ERROR_VIEW = 'Errors/DefaultError';
	
	////////////////////////////////////////////////////////////////////////////
	//Database connection information based on APP_STATE. Obviously, you can
	//add more if needed (QA, TestDeploy, etc)
	if(APP_STATE == 'development') {
		//$DB_USER='';
		//$DB_PASS='';
		//$DB_NAME='';
		//$DB_HOST='';
		define('DB_USER', '');
		define('DB_PASS', '');
		define('DB_NAME', '');
		define('DB_HOST', '');
		//turn on all system error reporting (set to E_USER_WARNING E_ALL for 
		//everything)
		error_reporting(E_ALL);
	} else {
		//$DB_USER='';
		//$DB_PASS='';
		//$DB_NAME='';
		//$DB_HOST='';
		define('DB_USER', '');
		define('DB_PASS', '');
		define('DB_NAME', '');
		define('DB_HOST', '');
		//turn off all system error reporting
		error_reporting(0);
	}
	////////////////////////////////////////////////////////////////////////////
	
	//$LINK_PATH = $INSTALL_PATH . '/' . $INDEX_PAGE . $FILE_EXT . '?' . $URL_COMMAND_VAR . '=';
	define('LINK_PATH', INSTALL_PATH . '/' . INDEX_PAGE . FILE_EXT . '?' . URL_COMMAND_VAR . '=');
	//$LINK_DELIM = $C_M_DELIMITER;
	define('LINK_DELIM', C_M_DELIMITER);
		
	////////////////////////////////////////////////////////////////////////////
	/**
	 * Variable: ERRORS
	 * 	all the errors should go here (if Utils is used)
	 */
	$ERRORS = array();
	//all queries will go here if the model object extends DataObject and it's debug mode
	$QUERIES = array();
	//all queries times will go here the model extends DataObject and it's debug mode
	$QUERIES_TIME = array();
	/**
	 * Variable: TRACE
	 * 	used to trace steps though the frame work see the Utils Object
	 */
	$TRACE = array();
?>