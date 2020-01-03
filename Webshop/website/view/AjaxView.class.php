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
		$innerTpl = __DIR__ ."/ajax_templates/$tpl.php";
		if(!file_exists($innerTpl)) {
			throw new Exception("The template '$innerTpl' does not exist!");
		}
		foreach($this->controller->getData() as $key=>$value) {
			$$key = $value;
		}
		
		include __DIR__ ."/ajax_templates/ajax.php";
	}
}
