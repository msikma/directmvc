<?php
class Df_Helper_PartialHelper
{
    public static function includeComponent($controllerName, $methodName, $vars = array())
    {
        $request = new Df_Request();
        $request->setRoute(Df_Routing::getActiveRoute());

        $controller = new $controllerName($request, $vars);
        $controller->{$methodName}($request, $vars);
    }
}