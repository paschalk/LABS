<?php 
	define('DB_SERVER', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'labs');

class DBConnector{
	public $conn;

	function __construct(){
 $this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASS) or die("Error: ".mysqli_error());
      // var_dump($this->conn);
      // die();
      mysqli_select_db($this->conn, DB_NAME);
    }
 
    public function closeDatabase(){
      mysqli_close($this->conn);
    }
  }

?>