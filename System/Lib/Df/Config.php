<?php
/**
* DirectMVC: A clean and to the point MVC framework
* 
* Simple configuration class; Statically assign values that
* can be used across the entire framework
* 
* @author Ruben K. <ruben@directdevelopment.nl>
* @version 0.1
* @package DirectMVC
*/

/**
* Df_Config
* 
* This class is a very simple configuration loader
* that can statically transfer configuration values
* all across the framework
* 
* @author Ruben K. <ruben@directdevelopment.nl>
* @version 0.1
* @package DirectMVC
*/
class Df_Config
{
	/**
	* @var array This array will contain all configuration values
	*/
    private static $_parameters = array();

	/**
	* get
	* 
	* Use this method to get a configuration value
	* 
	* @param string $name The name of the configuration value
	* @param mixed $default Used to set the default value when no item was found
	* @return mixed
	*/
    public static function get( $name, $default = null )
    {
    	/**
    	* Check if this configuration value exists
    	*/
        if ( self::has( $name ) ){
        	/**
        	* It does; Return it
        	*/
            return self::$_parameters[$name];
        }

        /**
        * It doesn't; Return the default value (if there is one)
        */
        return $default;
    }

    /**
    * gets
    * 
    * This method returns the entire array of configuration values
    * 
    * @return array
    */
    public static function gets()
    {
    	/**
    	* Just return the entire array
    	*/
        return self::$_parameters;
    }

    /**
    * has
    * 
    * This method is used to test if a configuration value
    * exists.
    * 
    * @param string $name The name of the configuration setting
    * @return boolean
    */
    public static function has( $name )
    {
    	/**
    	* Return true when the parameter was found
    	*/
        return isset( self::$_parameters[$name] );
    }

    /**
    * set
    * 
    * This method is used to set a new configuration value
    * 
    * @param string $name
    * @param mixed $value The value of the configuration setting
    * @param boolean $override When set to false, it will not override settings
    * @return void
    */
    public static function set( $name, $value, $override = true )
    {
    	/**
    	* Assign as array key to our configurations array
    	*/
        self::$_parameters[$name] = $value;
    }
    
    /**
    * setArray
    * 
    * You can set an entire array of configuration values using
    * this method. It has an optional override setting that will allow
    * you to prevent settings from being overridden if they already exist
    * 
    * @param array $arr The array with configuration options
    * @param boolean $override When set to false, it will not override settings
    * @return void
    */
    public static function setArray( $arr, $override = true )
    {
    	/**
    	* Loop through our provided array and assign each value
    	* to our configurations array
    	*/
		foreach( $arr as $name => $value ){
			/**
			* When override has been set to false it will only
			* assign when the value does not exist yet
			*/
			if( $override == true || !self::has( $name ) ){
				self::$_parameters[$name] = $value;
			}
		}
    }
}