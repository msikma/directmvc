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
* This constant will contain the real path to the www-folder where the framework is located
*/
define( 'BASEPATH', realpath(dirname(__FILE__)) . '/' );

/**
* Require the framework initialization mechanism
*/
require_once( BASEPATH . 'System/Lib/Config.php' );

/**
* Dispatch the routing, which calls upon the
* proper controller.
*/
Df_Routing::dispatch();