<?php
/**
* DirectMVC: A clean and to the point MVC framework
* 
* The controller base class; This contains all kinds of
* useful helpers to bind requests to actions
* 
* @author Ruben K. <ruben@directdevelopment.nl>
* @version 0.1
* @package DirectMVC
*/

/**
* Df_Controller
* 
* @author Ruben K. <ruben@directdevelopment.nl>
* @version 0.1
* @package DirectMVC
*/
class Df_Controller
{	
	/**
	* view
	* 
	* This method initializes a new h2o templating engine
	* instance. You can dynamically extend the options by setting
	* $additional_options
	* 
	* @param string $view_name The template filename
	* @param mixed $additional_options Either false or an array of additional h2o options
	* @return h2o
	*/
	protected function view( $view_name, $additional_options = false )
	{
		$configuration_array = array(
			'searchpath' => APP_PATH . 'Views'
		);
		
		/**
		* Do we have to merge the additional options with the
		* original ones?
		*/
		if( is_array( $additional_options ) ){
			/**
			* Merge our two arrays into one!
			*/
			$configuration_array = array_merge( $configuration_array, $additional_options );
		}
		
		/**
		* Return a new h2o instance!
		*/
		return new h2o( $view_name, $configuration_array );
	}
}