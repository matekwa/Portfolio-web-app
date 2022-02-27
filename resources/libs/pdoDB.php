<?php
/**
 PDO database class
 */
class Database{
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASSWORD;
	private $dbname = DB_NAME;

	private $stmt;
	private $dbh;
	private $error;


	public function __construct(){
		$dsn = "mysql:host=".$this->host.";dbname=".$this->dbname;

		$options = array(
			PDO::ATTR_PERSISTENT =>true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		//Create a new PDO instance
			try {
				$this->dbh = new pdo($dsn,$this->user,$this->pass, $options);
			} catch (PDOException $e) {
				$this->error = $g->getMessage();
			}
	}

	//Query function with prepared statement
	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}

	//Bind values
	public function bind($param, $value, $type = null){
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	//Execute the prepared statement
	public function execute(){
		return $this->stmt->execute();
	}

	//Return a result set as an array of objects
	public function resultSet(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	//Return single result as an object
	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	//Get record row count
	public function rowCount(){
		return $this->stmt->rowCount();
	}

	//Return the last inserted ID
	public function lastID(){
		return $this->dbh->lastInsertId();

	}
}