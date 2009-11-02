<?php
class Df_Controller
{	
	protected function view( $view_name )
	{
		return new h2o( $view_name, array(
			'searchpath' => APP_PATH . 'Views'
		) );
	}
	
	protected function model( $model_name )
	{
		return new $model_name;
	}
	
    protected function _forward($name, $parameters = array())
    {
        Df_Helper_RoutingHelper::forward($name, $parameters);
    }

    protected function _forwardIf($condition, $name, $parameters = array())
    {
        Df_Helper_RoutingHelper::forwardIf($condition, $name, $parameters);
    }

    protected function _forwardUnless($condition, $name, $parameters = array())
    {
        Df_Helper_RoutingHelper::forwardUnless($condition, $name, $parameters);
    }

    protected function _redirect($url, $parameters = array())
    {
        Df_Helper_RoutingHelper::redirect($url, $parameters);
    }

    protected function _redirectIf($condition, $url, $parameters = array())
    {
        Df_Helper_RoutingHelper::redirectIf($condition, $url, $parameters);
    }

    protected function _redirectUnless($condition, $url, $parameters = array())
    {
        Df_Helper_RoutingHelper::redirectUnless($condition, $url, $parameters);
    }
}