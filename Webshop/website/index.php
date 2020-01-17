<?php
	// F R O N T   C O N T R O L L E R

	require_once './util/autoloader.php';

	$request = new Request();
	//$action = isset($_GET['action']) ? $_GET['action'] : 'home';
	$action = $request->getParameter('action', 'home');
	
	if (!file_exists('configuration/config.json')) {
		die("Unable to open configuration.");
	}
	//initialize config array
	$configuration = json_decode(file_get_contents("configuration/config.json"), true);

	// Inizialize model
	if (!DB::create(
		$configuration['database']['host'],
		 $configuration['database']['user'],
		  $configuration['database']['pw'],
		   $configuration['database']['db_name'])
		) {
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

