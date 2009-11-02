<?php
class ArticlesModel extends Df_Database_Model
{
	protected function Fields()
	{
		$this->title = new CharField();	
		$this->slug = new CharField();
	}        
	
	
	
}
