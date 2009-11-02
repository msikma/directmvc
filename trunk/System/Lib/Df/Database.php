<?php
class Df_Database
{
	private static $_dbh;
	private $link;
	
	public function __construct( $host = 'localhost', $user = 'root', $password = '', $database = 'test' )
	{
		$this->link = mysql_connect( $host, $user, $password );
		mysql_select_db( $database, $this->link );
		
		if( mysql_error() ){
			echo 'A database connection could not be established...';
			exit;
		}
	}
	
	/**
	* getInstance
	* 
	* This static method initializes a database connection
	* on demand, meaning it will only initialize one when 
	* it is called upon.
	* 
	* @author Ruben K. <ruben@directdevelopment.nl>
	* @return Df_Database
	*/
	public static function getInstance()
	{
		/**
		* Only create a new instance when there's not
		* one already in our static property
		*/
		if (is_null(self::$_dbh)) {
			
			/**
			* Use the database settings from the config
			* class to connect to MySQL
			*/
			$database_host = Df_Config::get( 'database_host' );
			$database_user = Df_Config::get( 'database_user' );
			$database_password = Df_Config::get( 'database_password' );
			$database_database = Df_Config::get( 'database_database' );
			
			/**
			* Store this new instance in it's private 
			* property
			*/
            self::$_dbh = new Df_Database( $database_host, $database_user, $database_password, $database_database );
        }
        
        return self::$_dbh;
	}
	
	public function all( $query )
	{
		$result = mysql_query( $query );
		if( mysql_num_rows( $result ) > 0 ){
			
		}
	}
}
