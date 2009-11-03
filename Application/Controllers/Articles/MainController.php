<?php
class Articles_MainController extends Df_Controller
{
	function Index( Df_Request $request )
	{
		$db = Df_Database::getInstance();
		$arr = $db->all( "SELECT * FROM articles" );
		print_r( $arr );
	}
	
	function View( Df_Request $request, $slug )
	{
		return 'Slug: ' . $slug;
	}
}
