<?php
/*
    Controller class inspired by topic 11 MVC
*/

class Controller {    
	private $data = array();
	private $title = "";

	// A C T I O N S
	public function home(Request $request) {
		$this->initializeController($request);
		$this->title = "Home";
		$this->data["articles"] = Article::getArticles();
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

	private function initializeController($request){
		$this->startSession();
		$this->setLanguage($request);
		$this->data["language"] = $_SESSION["language"];		
		$this->startCart();
		$this->data["cart"] = $_SESSION['cart'];
	}

	private function startSession() {
		if ($this->sessionState == false) {
			$this->sessionState = session_start();
		}
	}

	//Starts the cart
	//Questionable naming
	private function startCart() {
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = new Cart();
		}
	}

	private function setLanguage(Request $request)
	{			
		//Get language, default german		
		if($request->isParameter('language') || !isset($_SESSION['language']))
		{
			$_SESSION['language'] = $request->getParameter('language', 'de-CH');
		}
	}

	//https://codular.com/curl-with-php
	private function importMemesFromReddit($subreddit)
	{
		// Get cURL resource
		$curl = curl_init();

		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, [
			CURLOPT_RETURNTRANSFER => 1,
			//Reddit-API-Doc https://www.reddit.com/dev/api#GET_search
			CURLOPT_URL => 'https://www.reddit.com/r/' . $subreddit .'/search.json?q=a&sort=top&restrict_sr=1&limit=3000&t=month&limit=20'
		]);

		// Send the request & save response to $resp
		$resp = json_decode(curl_exec($curl), true);
		// Close request to clear up some resources
		curl_close($curl);

		return $resp;
	}
}
