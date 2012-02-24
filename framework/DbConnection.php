<?php

class DbConnection {
	
	protected $pdo;
	
	protected static $dbConnection;
	
	protected function __construct() {
		$config = Config::get('dbConnection');
		$dsn = $config['system'] . ':dbname=' . $config['db'] . ';' . 'host=' . $config['host'];
		$username = $config['username'];
		$password = $config['password'];
		$pdo = new PDO($dsn, $username, $password);
		$this->pdo = $pdo;
	}
	
	public static function getInstance() {
		if (!isset(self::$dbConnection)) {
			self::$dbConnection = new DbConnection();
		}
		
		return self::$dbConnection;
	}
	
	public function getPdo() {
		return $this->pdo;
	}
	
}