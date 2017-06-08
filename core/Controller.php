<?php

include 'models/config.php';

class controller {

	private $config;

	public function __construct() {
		$cfg = new Config();
		$this->config = $cfg->getConfig();
	}
	
	public function loadTemplateInPainel($viewName, $viewData = array()) {
		include 'views/painel.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

}