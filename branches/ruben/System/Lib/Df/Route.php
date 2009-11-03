<?php
class Df_Route
{
    private $_url;
    private $_controller;
    private $_method;
    private $_name;
    private $_pattern;
    private $_parameters = array();


    public function __construct($route)
    {
        $this->_url             = $route['url'];
        $this->_controller      = $route['controller'];
        $this->_method          = $route['method'];
        $this->_name            = $route['name'];
        $this->_pattern         = $route['pattern'];
        $this->_parameters      = $route['parameters'];
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function getController()
    {
        return $this->_controller;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getPattern()
    {
        return $this->_pattern;
    }

    public function getParameter($name, $default = null)
    {
        if ($this->hasParameter($name))
        {
            return $this->_parameters[$name];
        }

        return $default;
    }

    public function getParameters()
    {
        return $this->_parameters;
    }

    public function hasParameter($name)
    {
        return isset($this->_parameters[$name]);
    }

    public function setParameter($name, $value)
    {
        $this->_parameters[$name] = $value;
    }

    public function setParameters($arr)
    {
        $this->_parameters = array_merge($this->_parameters, $arr);
    }
}
