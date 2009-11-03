<?php
/**
* DirectMVC: A clean and to the point MVC framework
* 
* A very basic database abstraction
* 
* @author Ruben K. <ruben@directdevelopment.nl>
* @version 0.1
* @package DirectMVC
*/

/**
* Df_Database
* 
* A very basic database abstraction class
* 
* @author Ruben K. <ruben@directdevelopment.nl>
* @version 0.1
* @package DirectMVC
*/
class Df_Database
{
	/**
	* @var Df_Database This static property will contain an instance of this class
	*/
	private static $_dbh;
	
	/**
	* @var mixed MySQL link identifier is stored here
	*/
	private $link;
	
	/**
	* __construct
	* 
	* Creates a new instance of the database class
	* 
	* @param string $host The MySQL server
	* @param string $user The MySQL username
	* @param string $password The MySQL password
	* @param string $database The MySQL database
	* @return void
	*/
	public function __construct( $host = 'localhost', $user = 'root', $password = '', $database = 'test' )
	{
		/**
		* Connect to the database using provided settings
		*/
		$this->link = mysql_connect( $host, $user, $password );
		mysql_select_db( $database, $this->link );
		
		/**
		* @todo Proper error handling...
		*/
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
	
	/**
	* all
	* 
	* This method returns all results using this class's
	* method _results
	* 
	* @param string $query The MySQL query to be executed
	* @return array 
	*/
	public function all( $query )
	{
		return $this->_results( $query );
	}
	
	/**
	* limit
	* 
	* This method returns limited resultsets using this class's
	* method _results
	* 
	* @param mixed $query The MySQL query you want executed
	* @param mixed $offset The offset
	* @param mixed $limit The amount of items you want to fetch
	* @return array
	*/
	public function limit( $query, $offset, $limit )
	{
		$query .= ' LIMIT ' . $offset . ', ' . $limit;
		return $this->_results( $query );
	}
	
	/**
	* _results
	* 
	* Returns a set of results, but only when there's more
	* than zero rows
	* 
	* @param mixed $query The MySQL query
	* @return mixed
	*/
	private function _results( $query )
	{
		$result = mysql_query( $query );
		if( mysql_num_rows( $result ) > 0 ){
			$result_arr = array();
			while( $row = mysql_fetch_assoc( $result ) ){
				$result_arr[] = $row;
			}
			
			return $result_arr;
		}
		
		return false;
	}
}
