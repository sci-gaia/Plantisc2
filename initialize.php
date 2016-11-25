<?php die("miracles happen");
// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : 
	define('SITE_ROOT', DS.'opt'.DS.'lampp'.DS.'htdocs'.DS.'unesco');

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

defined('CONFIG_') ? null : 
	define('CONFIG_', DS.'opt'.DS.'lampp'.DS.'config_');


/** Error reporting */
error_reporting(E_ALL ^ E_WARNING);


// load config file first
require_once(CONFIG_.DS.'unesco.php');

// load PHPExcel library
require_once(SITE_ROOT.DS.'Classes/PHPExcel.php');

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'pagination.php');

// load database-related classes
require_once(LIB_PATH.DS.'admin.php');
require_once(LIB_PATH.DS.'upload.php');


?>