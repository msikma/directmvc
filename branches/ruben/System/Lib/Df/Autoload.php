<?php
/**
* DirectMVC: A clean and to the point MVC framework
* 
* @author Ruben K. <ruben@directdevelopment.nl>
* @version 0.1
* @package DirectMVC
*/

/**
* Df_Autoload
* 
* This class is called upon each time a non-existing class
* is requested, and will attempt to find the class requested.
* 
* @author Ruben K. <ruben@directdevelopment.nl>
* @version 0.1
* @package DirectMVC
*/
class Df_Autoload
{
	/**
	* @var array This array will contain the directories where
	* 			 php will look for the missing classes
	*/
    private static $_directories = array();

	/**
	* autoload
	* 
	* This method loops through the packages array and attempts
	* to find the classes in all the packages.
	* 
	* @param string $className The class to be loaded
	* @return void
	*/
    public static function autoload($className)
    {                  
    	/**
    	* Split up the classname to determine if
    	* we want to look in sub-packages
    	*/
        $arr = explode('_', $className);

        /**
        * The last piece of the array is the
        * classname
        */
        $filename = array_pop($arr);

        /**
        * Build a relative path of the package +
        * the classname to find out where to look
        */
        $className = implode('/', $arr).'/'.$filename.'.php';

        /**
        * Look in all package directories for the
        * class we need to include
        */
        foreach (self::$_directories as $directory)
        {
        	/**
        	* Only files are welcome... it might as
        	* well be a sub-package!
        	*/
            if (is_file($directory.$className))
            {
            	/**
            	* Found it! Require it only once and break
            	* out of the loop because we're done!
            	*/
                require_once $directory.$className;
                break;
            }
        }
    }

    /**
    * addPackage
    * 
    * This method adds a package directory to our
    * package array.
    * 
    * @param string $directory The package directory
    * @return void
    */
    public static function addPackage($directory)
    {
    	/**
    	* Create a new array entry in our static
    	* property
    	*/
        self::$_directories[] = $directory;
    }
}