<?php
class Df_Request
{
    private $_route;


    public function isMethod($method)
    {
        if ($_SERVER['REQUEST_METHOD'] == strtoupper($method))
        {
            return true;
        }

        return false;
    }

    public function getGetParameter($name, $default = null)
    {
        if ($this->hasGetParameter($name))
        {
            return $_GET[$name];
        }

        return $default;
    }

    public function getGetParameters()
    {
        return $_GET;
    }

    public function hasGetParameter($name)
    {
        return isset($_GET[$name]);
    }

    public function setGetParameter($name, $value)
    {
        $_GET[$name] = $value;
    }

    public function setGetParameters($arr)
    {
        $_GET = array_merge($_GET, $arr);
    }

    public function getPostParameter($name, $default = null)
    {
        if ($this->hasPostParameter($name))
        {
            return $_POST[$name];
        }

        return $default;
    }

    public function getPostParameters()
    {
        return $_POST;
    }

    public function hasPostParameter($name)
    {
        return isset($_POST[$name]);
    }

    public function setPostParameter($name, $value)
    {
        $_POST[$name] = $value;
    }

    public function setPostParameters($arr)
    {
        $_POST = array_merge($_POST, $arr);
    }

    public function getRoute()
    {
        return $this->_route;
    }

    public function setRoute(Df_Route $route)
    {
        $this->_route = $route;
    }

    public function getRouteParameter($name, $default = null)
    {
        return $this->getRoute()->getParameter($name, $default);
    }

    public function getRouteParameters()
    {
        return $this->getRoute()->getParameters();
    }

    public function hasRouteParameter($name)
    {
        return $this->getRoute()->hasParameter($name);
    }

    public function setRouteParameter($name, $value)
    {
        $this->getRoute()->setParameter($name, $value);
    }

    public function setRouteParameters($arr)
    {
        $this->getRoute()->setParameters($arr);
    }
}