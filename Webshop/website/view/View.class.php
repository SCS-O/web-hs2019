<?php

/*
    View class provided in Topic 11
    Author: Mr. Locher
*/

class View {

	private $controller;

	public function __construct(Controller $controller) {
		$this->controller = $controller;
	}

	public function render($tpl) {
		$innerTpl = __DIR__ ."/templates/$tpl.php";
		if(!file_exists($innerTpl)) {
			throw new Exception("The template '$innerTpl' does not exist!");
		}
		foreach($this->controller->getData() as $key=>$value) {
			$$key = $value;
		}
		$title = $this->controller->getTitle();
		$title = "MVC" .($title ? " - ".$title : "");

		//this is only for visual purposes security is handled by the controllers
		if($this->controller->isAdmin())
		{
			include __DIR__ ."/templates/admin.php";
		}
		else{
			include __DIR__ ."/templates/main.php";
		}
	}
}
