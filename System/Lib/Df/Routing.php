<?php
class Df_Routing
{
    private static $_routes;
    private static $_activeRoute;


    public static function dispatch()
    {
        self::$_routes = self::_getRoutes('routes');

        $uri = explode('?', $_SERVER['REQUEST_URI']);
        $uri = reset($uri);

        if (isset(self::$_routes['simple'][$uri]))
        {
            $activeRoute = self::$_routes['simple'][$uri];
        }
        else
        {
            foreach (self::$_routes['advanced'] as $route)
            {
                if (preg_match($route['pattern'], $uri, $matches))
                {
                    $parameters = array();

                    for ($i = 1; $i < $c = count($matches); $i++)
                    {
                        $parameters[$route['parameters'][$i - 1]] = $matches[$i];
                    }

                    $route['parameters'] = $parameters;

                    $activeRoute = $route;

                    break;
                }
            }
            
        }

        if (isset($activeRoute))
        {
            self::initRoute(new Df_Route($activeRoute));
        }
        else{
			echo 'Error 404.';
        }
    }

    public static function initRoute(Df_Route $route)
    {
        self::$_activeRoute = $route;

        $request = new Df_Request();
        $request->setRoute($route);

        $controllerName = $route->getController();
        
        $route_parameters = $route->getParameters();
        
        $controller_parameters = array( $request );
        $controller_parameters = array_merge( $controller_parameters, $route_parameters );

        $controller = new $controllerName($request);
        //$controller->{$route->getMethod()}($request);

        $result = call_user_func_array( array( $controller, $route->getMethod() ), $controller_parameters );
        echo $result;
    }

    public static function getActiveRoute()
    {
        if (self::$_activeRoute)
        {
            return self::$_activeRoute;
        }

        return null;
    }

    public static function getRoute($name, $parameters = array())
    {
        if (self::$_routes && isset(self::$_routes['all'][$name]))
        {
            $route = self::$_routes['all'][$name];

            $url = explode('/', $route['url']);
            $routeParameters = array();

            foreach ($url as $k => $subroute)
            {
                if (substr($subroute, 0, 1) == ':')
                {
                    if ($strpos = strpos($subroute, '='))
                    {
                        $url[$k] = $parameters[substr($subroute, 1, $strpos - 1)];
                        $routeParameters[substr($subroute, 1, $strpos - 1)] = $url[$k];
                    }
                    else
                    {
                        $url[$k] = $parameters[substr($subroute, 1)];
                        $routeParameters[substr($subroute, 1)] = $url[$k];
                    }
                }
                elseif (substr($subroute, 0, 1) == '#')
                {
                    $url[$k] = $parameters[substr($subroute, 1)];
                    $routeParameters[substr($subroute, 1)] = $url[$k];
                }
            }

            $route['url'] = implode('/', $url);
            $route['parameters'] = $routeParameters;

            return new Df_Route($route);
        }

        return null;
    }

    private static function _getRoutes($filename, $parentRoute = null)
    {
        $routesFilename = Df_Config::get('df_routes_dir').$filename.'.yaml';
        $cacheFilename = Df_Config::get('df_cache_dir').$filename.'.cache';

        if (is_file($cacheFilename))
        {
            $routes = unserialize(file_get_contents($cacheFilename));
        }
        else
        {
            $routes = self::_generateRoutes(Spyc::YAMLLoad($routesFilename), $parentRoute);

            /**if (!$parentRoute && LIVE)
            {
                $handle = fopen($cacheFilename, 'w');
                fwrite($handle, serialize($routes));
                fclose($handle);
            }*/
        }

        return $routes;
    }

    private static function _generateRoutes($routes, $parentRoute = null)
    {
        $simpleRoutes = array();
        $advancedRoutes = array();
        $allRoutes = array();

        foreach ($routes as $name => $route)
        {
            if ($parentRoute)
            {
                $route['url'] = $parentRoute['url'].$route['url'];
            }

            if (isset($route['controller']))
            {
                $patterns = array();
                $parameters = array();

                $simple = true;

                $route['url'] = str_replace('//', '/', $route['url']);

                foreach (explode('/', $route['url']) as $subroute)
                {
                    if (substr($subroute, 0, 1) == ':')
                    {
                        if ($strpos = strpos($subroute, '='))
                        {
                            $patterns[] = '('.substr($subroute, $strpos + 1).')';
                            $parameters[] = substr($subroute, 1, $strpos - 1);
                        }
                        else
                        {
                            $patterns[] = '([^\/]+)';
                            $parameters[] = substr($subroute, 1);
                        }

                        $simple = false;
                    }
                    elseif (substr($subroute, 0, 1) == '#')
                    {
                        $patterns[] = '(\d+)';
                        $parameters[] = substr($subroute, 1);

                        $simple = false;
                    }
                    else
                    {
                        $patterns[] = preg_quote($subroute);
                    }
                }

                if (!isset($route['method']) || empty($route['method']))
                {
                    $route['method'] = 'start';
                }

                $route['name'] = $name;
                $route['pattern'] = '/^'.implode('\/', $patterns).'$/';
                $route['parameters'] = $parameters;

                if ($simple)
                {
                    $simpleRoutes[$route['url']] = $route;
                }
                else
                {
                    $advancedRoutes[$route['name']] = $route;
                }

                $allRoutes[$route['name']] = $route;
            }

            if (isset($route['include']))
            {
                $includedRoutes = self::_getRoutes($route['include'], $route);

                $simpleRoutes = array_merge($simpleRoutes, $includedRoutes['simple']);
                $advancedRoutes = array_merge($advancedRoutes, $includedRoutes['advanced']);
                $allRoutes = array_merge($allRoutes, $includedRoutes['all']);
            }
        }

        return array('simple' => $simpleRoutes, 'advanced' => $advancedRoutes, 'all' => $allRoutes);
    }
}