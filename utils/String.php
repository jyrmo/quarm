<?php

namespace Util;

class String {
	
	public static function toCamelCase($str, $isCapitalized = false) {
		$arrWords = preg_split('/( |-)/', $str);
		
		$strCamelCase = '';
		foreach ($arrWords as $index => $word) {
			if (!$isCapitalized && $index == 0) {
				$strCamelCase .= lcfirst($word);
			} else {
				$strCamelCase .= ucfirst($word);
			}
		}
		
		return $strCamelCase;
	}
	
	public static function toDashDelimited($str) {
		$str = lcfirst($str);
		$func = create_function('$arg', 'return "-" . strtolower($arg[1]);');
		return preg_replace_callback('/([A-Z])/', $func, $str);
	}
}