<?php
class Error404 extends Exception
{
	function __construct()
	{
		echo 'Error 404!';
	}
}
