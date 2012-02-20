<?php

class Session {
	
	protected static $session;
	
	protected function __construct() {
		// TODO
	}
	
	public static function getInstance() {
		if (!isset(self::$session)) {
			self::$session = new Session();
		}
		
		return self::$session;
	}
	
	public function start() {
		return session_start();
	}
	
	public function __set($key, $val) {
		$_SESSION[$key] = $val;
		
		return $this;
	}
	
	public function __get($key) {
		$result = isset($_SESSION[$key]) ? $_SESSION[$key] : null;
		
		return $result;
	}
	
	public function __isset($key) {
		return isset($_SESSION[$key]);
	}
	
	public function __unset($key) {
		unset($_SESSION[$key]);
		
		return $this;
	}
	
	public function destroy() {
		session_destroy();
		
		return $this;
	}
	
}