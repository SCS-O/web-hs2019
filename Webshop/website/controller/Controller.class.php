<?php

/*
    Controller class inspired by topic 11 MVC

*/

class Controller {
    
	private $data = array();
	private $title = "";

	// A C T I O N S
	public function home(Request $request) {
		$this->data["message"] = "Hello World!";
		$this->title = "Home";
	}

	public function contact(Request $request) {
		$this->title = "Contact";
	}

    //exception if the action does not exist
	public function __call($function, $args) {
		throw new Exception("The action '$function' does not exist!");
	}
    
	//Properties
	public function &getData() {
		return $this->data;
    }
    
	public function getTitle() {
		return $this->title;
	}

    
	// P R I V A T E  H E L P E R S

	private $sessionState = false;

	private function startSession() {
		if ($this->sessionState == false) {
			$this->sessionState = session_start();
		}
	}
}
