<?php
class CharField extends BaseField
{
	public function test()
	{
		
	}
	
	public function __tostring()
	{
		return $this->value;
	}
}
