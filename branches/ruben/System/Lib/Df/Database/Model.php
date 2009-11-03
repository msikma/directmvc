<?php
class Df_Database_Model
{
	/**
	* The fields will be contained here
	* 
	* @var array
	*/
	protected $fields_array = array();
	
	/**
	* The database class will be contained here
	* 
	* @var Df_Database
	*/
	private $dbh;
	
	public function __construct()
	{
		/**
		* Either fetch the active database connection
		* or initialize a new one
		*/
		$this->dbh = Df_Database::getInstance();
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
			* 
			* @todo Proper error handling...
			*/
			echo 'This database field does not exist...';
			exit;
		}
	}
	
	/**
	* __get
	* 
	* Retrieve database field properties using this
	* method, error when the fields are non-existant
	* 
	* @param string $var
	*/
	public function __get( $var )
	{
		/**
		* Do we have this
		*/
		if( isset( $this->fields_array[$var] ) ){
			/**
			* Return the database field when called for.
			* 
			* @todo Decide whether to return it's value or
			* 		the entire object that can be used at a later
			* 		time
			*/
			return $this->fields_array[$var]->getData();
		}
		
		/**
		* No such field exists...
		* 
		* @todo Proper error handling...
		*/
		echo 'This database field does not exist...';
		exit;
	}
}
