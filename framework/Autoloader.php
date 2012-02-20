<?php

class Autoloader {
	
	public static function getInstance() {
		return new Autoloader();
	}
	
	public function __construct() {
		
	}
	
	public function load($dirs = array ()) {
		foreach ($dirs as $dir) {
			$dirPath = rtrim($dir, '/');
			$files = scandir($dirPath);
			foreach ($files as $file) {
				$filePath = $dirPath . '/' . $file;
				if (is_file($filePath)) {
					require_once $filePath;
				}
			}
		}
	}
	
}