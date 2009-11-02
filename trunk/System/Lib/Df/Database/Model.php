<?php
class Df_Database_Model
{
	protected $fields_array = array();
	public static $_dbh;
	
	public function __construct()
	{
		Df_Database::getInstance();
		$this->Fields();
	}
	
	/**
	* get
	* 
	* This method is used to select either a single row or a set
	* of rows that meet specified criteria
	* 
	* @param array $options
	* @return ArticlesModel
	*/
	public static function get( $options )
	{
		
		return new ArticlesModel();
	}
	
	function save()
	{
		// Do the save!
	}
	
	/**
	* __set
	* 
	* This method catches all non-existing properties and
	* turns them into database fields. This way when setting
	* properties in your model it will store them as database fields
	* and when using your model in a controller it will store values
	* inside the earlier defined database fields.
	* 
	* @author Ruben K. <ruben@directdevelopment.nl>
	* @param string $var
	* @param BaseField $value
	*/
	public function __set( $var, $value )
	{
		
		/**
		* When setting a new field using a model subclass we
		* will store this field in our fields array
		*/
		if( $value instanceof BaseField && !isset( $this->fields_array[$var] ) ){
			$this->fields_array[ $var ] = $value;
			return;
		}
		
		/**
		* When setting data in a controller, we will
		* store the data in our database fields
		*/
		if( isset( $this->fields_array[$var] ) ){
			$this->fields_array[$var]->setData( $value );
		}
		else{
			/**
			* No such field exists...
			*/
			echo 'This database field does not exist...';
			exit;
		}
	}
	
	public function __get( $var )
	{
		if( isset( $this->fields_array[$var] ) ){
			return $this->fields_array[$var]->getData();
		}
	}
}
