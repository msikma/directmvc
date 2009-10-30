<?php
class Df_Helper_RoutingHelper
{
    public static function forward($name, $parameters = array())
    {
        if ($route = Df_Routing::getRoute($name, $parameters))
        {
            $parameters = Df_Helper_ArrayHelper::diff($parameters, $route->getParameters());

            foreach ($parameters as $name => $value)
            {
                $_GET[$name] = $value;
            }

            Df_Routing::initRoute($route);
        }
    }

    public static function forwardIf($condition, $name, $parameters = array())
    {
        if ($condition)
        {
            $this->forward($name, $parameters);
        }
    }

    public static function forwardUnless($condition, $name, $parameters = array())
    {
        if (!$condition)
        {
            $this->forward($name, $parameters);
        }
    }

    public static function redirect($url, $parameters = array())
    {
        if ($route = Df_Routing::getRoute($url, $parameters))
        {
            $url = $route->getUrl();

            $parameters = Df_Helper_ArrayHelper::diff($parameters, $route->getParameters());
        }

        $i = 0;

        foreach ($parameters as $name => $value)
        {
            $url .= (($i)?'&':'?').$name.'='.$value;

            $i++;
        }

        header('Location: '.$url);

        exit;
    }

    public static function redirectIf($condition, $url, $parameters = array())
    {
        if ($condition)
        {
            $this->_redirect($url, $parameters);
        }
    }

    public static function redirectUnless($condition, $url, $parameters = array())
    {
        if (!$condition)
        {
            $this->_redirect($url, $parameters);
        }
    }
}