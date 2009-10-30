<?php
class Articles_MainController extends Df_Controller
{
	function Index( Df_Request $request )
	{
		return 'Test!';
	}
	
	function View( Df_Request $request, $slug )
	{
		return 'Slug: ' . $slug;
	}
}
