<?php

abstract class AbstractController {
	
	protected $request;
	protected $view;
	
	public function __construct(Request $request) {
		$this->request = $request;
		$viewsPath = \Config::get('viewsPath');
		$viewPath = $viewsPath . '/' . $request->getControllerName() . '/' .  $request->getActionName() . '.phtml';
		$this->view = new \View();
		$this->view->setScriptPath($viewPath);
		$layoutsPath = \Config::get('layoutsPath');
		$defaultLayout = \Config::get('defaultLayoutScript');
		$this->view->setLayoutPath($layoutsPath . '/' . $defaultLayout);
	}
	
	public function setView(View $view) {
		$this->view = $view;
	}
	
	public function getView() {
		return $this->view;
	}
	
	protected function getGet() {
		return $this->request->getGet();
	}
	
	protected function getPost() {
		return $this->request->getPost();
	}
	
	protected function getParam($name, $default = null) {
		return $this->request->getParam($name, $default);
	}
	
	protected function getGetParam($name, $default = null) {
		return $this->request->getGetParam($name, $default);
	}
	
	protected function getPostParam($name, $default = null) {
		return $this->request->getPostParam($name, $default);
	}
	
	protected function redirect($controller = null, $action = null, $params = array ()) {
		$dispatcher = Dispatcher::getInstance();
		$dispatcher->redirect($controller, $action, $params);
	}
	
}