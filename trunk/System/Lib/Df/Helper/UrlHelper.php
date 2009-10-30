<?php
class Df_Helper_UrlHelper
{
    public static function urlFor($name, $parameters = array())
    {
        $route = Df_Routing::getRoute($name, $parameters);

        $url = $route->getUrl();

        $parameters = Df_Helper_ArrayHelper::diff($parameters, $route->getParameters());

        $i = 0;

        foreach ($parameters as $name => $value)
        {
            $url .= (($i)?'&':'?').$name.'='.$value;

            $i++;
        }

        return $url;
    }
}
