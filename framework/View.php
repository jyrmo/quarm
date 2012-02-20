<?php

class View {
	
	protected $isLayoutEnabled;
	
	protected $layoutPath;
	protected $scriptPath;

	public function __construct() {
		$this->isLayoutEnabled = true;
	}
	
	public function __toString() {
		$this->render();
	}
	
	public function render() {
		if ($this->isLayoutEnabled) {
			require_once $this->layoutPath;
		} else {
			return require_once $this->scriptPath;
		}
	}
	
	public function setScriptPath($path) {
		$this->scriptPath = $path;
	}
	
	public function setLayoutPath($path) {
		$this->layoutPath = $path;
	}
	
	public function getContent() {
		require_once $this->scriptPath;
	}
	
	public function disableLayout() {
		$this->isLayoutEnabled = false;
	}
	
	public function enableLayout() {
		$this->isLayoutEnabled = true;
	}
	
	public function action($controller, $action, $params = array ()) {
		$request = new Request($controller, $action, $params);
		$dispatcher = Dispatcher::getInstance();
		$dispatcher->setRequest($request);
		$view = $dispatcher->dispatch(false);
		$view->disableLayout();
		
		$view->render();
	}
	
}