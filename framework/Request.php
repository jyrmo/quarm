<?php

class Request {
	
	private $controllerName;
	private $actionName;
	private $get;
	private $post;
	
	public function __construct($controllerName = null, $actionName = null, $params = null) {
		$this->get = $params != null ? $params : $_GET;
		$this->post = $params != null ? array () : $_POST;
		$this->controllerName = $controllerName != null ? $controllerName : $this->getParam('controller', 'index');
		$this->actionName = $actionName != null ? $actionName : $this->getParam('action', 'index');
		if ($controllerName != null) {
			$this->get['controller'] = $controllerName;
		}
		if ($actionName != null) {
			$this->get['action'] = $actionName;
		}
	}
	
	public function getParam($name, $default = null) {
		$result = $default;
		if (isset($this->get[$name])) {
			$result = $this->get[$name];
		} elseif (isset($this->post[$name])) {
			$result = $this->post[$name];
		}
		
		return $result;
	}
	
	public function getGet() {
		return $this->get;
	}
	
	public function getPost() {
		return $this->post;
	}
	
	public function getGetParam($name, $default = null) {
		$result = $default;
		if (isset($this->get[$name])) {
			$result = $this->get[$name];
		}
		
		return $result;
	}
	
	public function getPostParam($name, $default = null) {
		$result = $default;
		if (isset($this->post[$name])) {
			$result = $this->post[$name];
		}
		
		return $result;
	}
	
	public function hasPost() {
		return !empty($this->post);
	}
	
	public function setControllerName($controllerName) {
		$this->controllerName = $controllerName;
		
		return $this;
	}
	
	public function getControllerName() {
		return $this->controllerName;
	}
	
	public function setActionName($actionName) {
		$this->actionName = $actionName;
		
		return $this;
	}
	
	public function getActionName() {
		return $this->actionName;
	}
	
}