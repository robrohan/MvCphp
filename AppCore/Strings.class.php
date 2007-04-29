<?php 
	/**
	 * File: AppCore/Strings.class.php
	 * 	Used to do i18n
	 *
	 * Copyright:
	 * 	2007 robrohan (rob.rohan@yahoo.com)
	 */
	
	/**
	 * Class: ImplStrings
	 * 	This class is used to get displayable string information
	 * based on locale. If you don't care about internationalizing
	 * your application you can ignore this class.
	 */
	class ImplStrings {
		
		function ImplStrings() {
			//use the application settings to load the proper
			//language file
			$app_lang = $GLOBALS['APP_LANG'];
			include_once(SERVER_INSTALL_PATH . '/Resources/Strings' 
				. ( (empty($app_lang)) ? '' : "_$app_lang" ) . FILE_EXT);
		}
		
		function Get($key, $default='', $items = array()) {
			if ( empty($GLOBALS['APPLICATION_STRINGS'][$key]) ) {
				$default = ( (empty($default)) ? '[['.$key.']]' : $default );
				return vsprintf($default, $items);
			} else {
				return vsprintf($GLOBALS['APPLICATION_STRINGS'][$key], $items);
			}
		}
	}

	/**
	 * Variable: Strings
	 * 	This is the implementation of ImplStrings one should use while using the
	 * framework.
	 * 
	 * SeeAlso:
	 *  <ImplStrings>
	 *
	 * Global:
	 *  true
	 */
	$Strings = new ImplStrings();
?>