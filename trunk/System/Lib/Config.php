<?php
/**
* DirectMVC: A clean and to the point MVC framework
* 
* The framework setup mechanism; This file loads in
* all of the base classes, controllers and models.
* 
* @author Ruben K. <ruben@directdevelopment.nl>
* @version 0.1
* @package DirectMVC
*/

/**
* This system's version number.
*/
define( 'DMVC_VERSION', '0.1' );

/**
* Define the paths required for autoloading
* our main libraries
*/
$Df_Base_Path = SYSPATH . 'Lib/';
$Df_System_Path = SYSPATH;
$Df_Application_Path = APPPATH;

/**
* Define the templating engine base path
*/
define( 'H2O_ROOT', $Df_Base_Path . 'External/h2o/' );
define( 'APP_PATH', $Df_Application_Path );

/**
* Require our autoload class
*/
require_once( $Df_Base_Path . 'Df/Autoload.php' );

/**
* Register the autoload callbacks
*/
spl_autoload_register( array( 'Df_Autoload', 'autoload' ) );
                                     
/**
* Add packages to be loaded by our autoload class;
* Load in all external libraries, all controllers and
* all models, as well as the framework base classes                  
*/
Df_Autoload::addPackage( $Df_Base_Path );
Df_Autoload::addPackage( $Df_Base_Path . 'External/' );
Df_Autoload::addPackage( $Df_Base_Path . 'External/h2o/' );
Df_Autoload::addPackage( $Df_Application_Path . 'Controllers/' );
Df_Autoload::addPackage( $Df_Application_Path . 'Model/' );

/**
* Set the configuration directives required for
* loading up the entire framework
*/
Df_Config::set( 'df_mvc_dir', $Df_Base_Path );
Df_Config::set( 'df_cache_dir', $Df_System_Path . 'Cache/Routes/' );
Df_Config::set( 'df_config_dir', $Df_System_Path . 'Config/' );
Df_Config::set( 'df_routes_dir', $Df_Application_Path . 'Routes/' );
Df_Config::set( 'df_lib_dir', $Df_Base_Path );