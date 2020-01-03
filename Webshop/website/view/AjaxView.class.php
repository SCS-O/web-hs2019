<?php

/*
    Ajax view class
*/

class AjaxView {

	private $controller;

	public function __construct(Controller $controller) {
		$this->controller = $controller;
	}

	public function render($tpl) {
		$tpl = __DIR__ ."/ajax_templates/$tpl.php";
		if(!file_exists($tpl)) {
			throw new Exception("The template '$tpl' does not exist!");
		}
		foreach($this->controller->getData() as $key=>$value) {
			$$key = $value;
		}
		
		include $tpl;
	}
}
