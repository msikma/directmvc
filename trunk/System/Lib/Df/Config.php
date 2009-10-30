<?php
class Df_Config
{
    private static $_parameters = array();


    public static function get($name, $default = null)
    {
        if (self::has($name))
        {
            return self::$_parameters[$name];
        }

        return $default;
    }

    public static function gets()
    {
        return self::$_parameters;
    }

    public static function has($name)
    {
        return isset(self::$_parameters[$name]);
    }

    public static function set($name, $value)
    {
        self::$_parameters[$name] = $value;
    }
}