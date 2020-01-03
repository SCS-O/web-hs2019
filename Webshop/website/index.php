<?php
	// F R O N T   C O N T R O L L E R

	require_once 'util/autoloader.php';

	$request = new Request();
	//$action = isset($_GET['action']) ? $_GET['action'] : 'home';
	$action = $request->getParameter('action', 'home');
	
    //TODO: Auslagern
    const HOST = "localhost";
    const USER = "www";
    const PW = "1234";
    const DB_NAME = "meme_shop";

	// Inizialize model
	if (!DB::create(HOST, USER, PW, DB_NAME)) {
		die("Unable to connect to database [".DB::getInstance()->connect_error."]");
	}

	try {
		// Create controller
		$controller = new Controller();

		//the action returns a new template if there was an internal redirect
		$tpl = $controller->$action($request);

		$tpl = $tpl ? $tpl : $action;

		//select view template
		//strpos hacks
		//https://stackoverflow.com/questions/4366730/how-do-i-check-if-a-string-contains-a-specific-word
		if(strpos($tpl, "ajax")  !== false)
		{
			$view = new AjaxView($controller);
		}
		else
		{
			$view = new View($controller);
		}

		// Create view
		$view->render($tpl);

	} catch (Exception $e) {
		die("<h2>There was an ERROR!</h2><p>There was an error processing action '$action'!</p><code> -> ".$e->getMessage()."</code>");
	}

