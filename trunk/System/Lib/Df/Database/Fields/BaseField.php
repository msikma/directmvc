<?php
class BaseField
{
	private $value;
	
	public function __construct()
	{

	}
	
	public function setData( $data )
	{
		$this->data = $data;
	}
	
	public function getData()
	{
		return $this->data;
	}
}