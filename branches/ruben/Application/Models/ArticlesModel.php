<?php
class ArticlesModel extends Df_Database_Model
{
	protected function Fields()
	{
		/**
		* Set which database table is used
		*/
		$this->_table = 'articles';
		
		$this->title = new CharField();	
		$this->slug = new CharField();
	}        
}
