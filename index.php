<?php
/**
* DirectMVC: A clean and to the point MVC framework
* 
* The initialization script; This script calls on the entire framework,
* extracts the routes, calls on controllers and includes autoloads.
* 
* @author Ruben K. <ruben@directdevelopment.nl>
* @version 0.1
* @package DirectMVC
*/


/**
* Set the name of the System folder here. Include the full path if
* it's not in the same directory, but don't use a trailing slash.
*
* e.g. 'System' or '/home/ruben/domains/mysite.com/System'.
*/
$system_folder = 'System';

/**
* In addition to the System folder, you can customise the location
* of the Application folder as well. Again, no trailing slash.
*/
$application_folder = 'Application';

/**
* Now let's set some constants that will be used throughout the
* framework. These are used to minimise the possibility of path
* problems down the road.
*
* The BASEPATH constant will contain the real path to the folder where the
* framework is located.
*/
define( 'BASEPATH', realpath(dirname(__FILE__)) . '/' );

/**
* Define the absolute system and application folder paths and
* converts them to Unix-style separators if necessary.
*/
$paths = array(
	array( 'SYSPATH', 'system_folder' ),
	array( 'APPPATH', 'application_folder' )
);
foreach ($paths as $k => $v) {
	$path = $$v[1];
	if (strpos($path, '/') === false) {
		$path = BASEPATH . $path;
	}
	define( $v[0], str_replace('\\', '/', $path) . '/' );
}

/**
* Defines this current file (probably 'index.php').
*/
define( 'SELF', pathinfo(__FILE__, PATHINFO_BASENAME) );

/**
* Require the framework initialization mechanism.
*/
require_once( SYSPATH . 'Lib/Config.php' );

/**
* Dispatch the routing, which calls upon the
* proper controller.
*/
Df_Routing::dispatch();