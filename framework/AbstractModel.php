<?php

abstract class AbstractModel {
	
	protected $dbConnection;
	
	public function __construct() {
		$this->dbConnection = DbConnection::getInstance();
	}
	
	public function getDbConnection() {
		return $this->dbConnection;
	}
	
	public function getPdo() {
		return $this->dbConnection->getPdo();
	}
	
}