<?php
class Articles_MainController extends Df_Controller
{
	function Index( Df_Request $request )
	{
		/**
		* Example of fetching an article from the database
		*
		$article = ArticlesModel::get( array(
			'pk' => 1
		) );
		
		echo $article->title;
		
		/**
		* Example of how we update an article
		*
		$article->title = 'Updated';
		$article->save();
		
		/**
		* Example of how we create a new article and save it
		*/
		$new_article = new ArticlesModel();
		$new_article->title = 'A Test Article';
		
		echo $new_article->title;
		$new_article->save(); // Inserts new article into the database
	}
	
	function View( Df_Request $request, $slug )
	{
		return 'Slug: ' . $slug;
	}
}
