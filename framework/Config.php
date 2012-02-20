<?php

/**
 * Class for accessing the configuration.
 */
class Config {

	/**
	 * Returns the value with the given key in the file set as CONFIG_FILEPATH.
	 * If no value with such key exists, returns the $default value.
	 *
	 * @param mixed $key
	 * @param mixed $default defaults to null
	 */
	public static function get($key, $default = null) {
		$configPath = CONFIG_FILEPATH;
		require $configPath;
		
		$result = $default;
		if (isset($config[$key])) {
			$result = $config[$key];
		}
		
		return $result;
	}
	
}