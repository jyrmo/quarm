<?php

use \Util\String;
use \Util\Url;

class Dispatcher {
	
	protected static $dispatcher;
	
	protected $request;
	
	public static function getInstance() {
		if (!isset(self::$dispatcher)) {
			self::$dispatcher = new Dispatcher();
		}
		
		return self::$dispatcher;
	}
	
	protected function __construct() {
		$this->request = new Request();
		$session = Session::getInstance();
		if (!$session->start()) {
			die('Could not start session');
		}
	}
	
	public function dispatch($render = true) {
		$controllerName = $this->request->getControllerName();
		$actionName = $this->request->getActionName();
		
		$controllerClassName = '\Controller\\' . String::toCamelCase($controllerName, true);
		if (class_exists($controllerClassName)) {
			$controller = new $controllerClassName($this->request);
			$actionMethodName = String::toCamelCase($actionName, false) . 'Action';
			if (method_exists($controller, $actionMethodName)) {
				$controller->$actionMethodName();
				if ($render) {
					echo $controller->getView()->render();
				} else {
					return $controller->getView();
				}
			} else {
				$this->dispatchErrorIndex($render);
			}
		} else {
			$this->dispatchErrorIndex($render);
		}
	}
	
	public function dispatchErrorIndex($render = true) {
		$this->request->setControllerName('error');
		$this->request->setActionName('index');
		$controller = new \Controller\Error($this->request);
		$controller->indexAction();
		if ($render) {
			echo $controller->getView();
		} else {
			return $controller->getView();
		}
	}
	
	protected function getParam($name, $default = null) {
		return $this->request->getParam($name, $default);
	}
	
	public function redirect($controller = null, $action = null, $params = array ()) {
		$baseUrl = Config::get('baseUrl');
		$redirectUrl = Url::composeUrl($baseUrl, $controller, $action, $params);
		header('Location: ' . $redirectUrl);
	}
	
	public function setRequest(Request $request) {
		$this->request = $request;
		
		return $this;
	}
	
}