<?php
class Df_Autoload
{
    private static $_directories = array();


    public static function autoload($className)
    {                                
        $arr = explode('_', $className);

        $filename = array_pop($arr);

        $className = implode('/', $arr).'/'.$filename.'.php';

        foreach (self::$_directories as $directory)
        {
            if (is_file($directory.$className))
            {
                require_once $directory.$className;
                //echo $className . '<br>';
                break;
            }
        }
    }

    public static function addPackage($directory)
    {
        self::$_directories[] = $directory;
        //echo $directory . '<br>';
    }
}