<?php

namespace Util;

class Url {
	
	public static function composeUrl($baseUrl, $controller = null, $action = null, $params = array ()) {
		$urlParams = $params;
		$urlParams['controller'] = $controller;
		$urlParams['action'] = $action;
		$paramStrs = array ();
		foreach ($urlParams as $key => $val) {
			$paramStrs[] = $key . '=' . $val;
		}
		$paramsStr = join('&', $paramStrs);
		
		$url = $baseUrl . '?' . $paramsStr;
		
		return $url;
	}
	
}