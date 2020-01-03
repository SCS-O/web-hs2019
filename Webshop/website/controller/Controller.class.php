<?php
/*
    Controller class inspired by topic 11 MVC
*/

class Controller {    
	private $data = array();
	private $title = "";
	private $isAdmin = false;
	private $translations = array();
	private $debugMessage = "";

	//Properties
	public function &getData() {
		return $this->data;
    }
    
	public function getTitle() {
		return $this->title;
	}

	public function getRequest() {
		return $this->data["request"];
	}

	public function getDebugMessage() {
		return $this->debugMessage;
	}

	public function isAdmin() {
		return $this->isAdmin;
	}

	// ACTION - Public 
	public function home(Request $request) {
		$this->initializeController($request);
		$this->title = "Home";
		$this->data["articles"] = Article::getArticles();
	}

	public function contact(Request $request) {
		$this->initializeController($request);
		$this->title = "Contact";
	}

	// ACTION - Logged - In


	//ACTION ADMIN

	public function admin_home(Request $request) {
		//TODO ADD ADMIN SECURITY
		$this->isAdmin = true;
		$this->initializeController($request);
		$this->title = "Admin Home";
	}

	public function admin_userlist(Request $request) {
		//TODO ADD ADMIN SECURITY
		$this->isAdmin = true;
		$this->initializeController($request);
		$this->title = "Admin User List";
		$this->data["accounts"] = Account::getAccounts();
	}

	public function admin_useredit(Request $request) {
		//TODO ADD ADMIN SECURITY
		$this->isAdmin = true;
		$this->initializeController($request);
		$this->title = "Admin User Edit";

		if(!$request->isParameter('accountid') || !Account::isAccount($request->getParameter('accountid')))
		{
			throw new Exception("Bad request");
		}

		//TODO ADD MESSAGE SUCESS SAVE


		$this->data["account"] = Account::getAccountById($request->getParameter('accountid'));
	}

	function admin_usersave(Request $request) {
		//TODO ADD ADMIN SECURITY
		$this->isAdmin = true;
		$this->initializeController($request);
		$this->title = "Admin User Edit";

		if(!$request->isParameter('accountid') || !Account::isAccount($request->getParameter('accountid')))
		{
			throw new Exception("Bad request");
		}
		else{
			//TODO Validation, security stuff
			$accountToEdit = Account::getAccountById($request->getParameter('accountid'));
			$has_changed = FALSE;

			if($request->isParameter('firstName')){
				$accountToEdit->setFirstName($request->getParameter('firstName'));
				$has_changed = TRUE;
			}
			if($request->isParameter('lastName')){
				$accountToEdit->setLastName($request->getParameter('lastName'));
				$has_changed = TRUE;
			}
			if($request->isParameter('address')){
				$accountToEdit->setAddress($request->getParameter('address'));
				$has_changed = TRUE;
			}
			if($request->isParameter('city')){
				$accountToEdit->setCity($request->getParameter('city'));
				$has_changed = TRUE;
			}
			if($request->isParameter('email')){
				$accountToEdit->setEmail($request->getParameter('email'));
				$has_changed = TRUE;
			}
			
			if($has_changed === TRUE)
			{
				$accountToEdit->saveObject();
			}
		}

		//TODO ADD MESSAGE SUCESS SAVE
		return $this->internalRedirect('admin_userlist', $request);
	}

	public function admin_meme_overview(Request $request) {
		//TODO ADD ADMIN SECURITY
		$this->isAdmin = true;
		$this->initializeController($request);
		$this->title = "Admin meme overview";

		$this->data["articles"] = Article::getArticles();
	}

    //exception if the action does not exist
	public function __call($function, $args) {
		throw new Exception("The action '$function' does not exist!");
	}
    
    
	// P R I V A T E  H E L P E R S
	private $sessionState = false;

	private function initializeController($request){
		$this->startSession();
		$this->setLanguage($request);
		
		$this->data["action"] = $request->getParameter('action', 'home');

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
	private function startCart() {
		$this->startSession();
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = new Cart();
		}
	}

	private function setLanguage(Request $request)
	{			
		$this->startSession();
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

	private function internalRedirect($action, $request) {
		$tpl = $this->$action($request);
		$this->data["action"] = $tpl ? $tpl : $action;
		return $tpl ? $tpl : $action;
	}

	//adapted from https://stackoverflow.com/questions/1974505/php-simple-translation-approach-your-opinion
	public function getTranslation($key)
	{
		if (!array_key_exists($this->data["language"], $this->translations)) {
			//TODO - file path to config?
            if (file_exists('internationalization/' . $this->data["language"] .'.txt')) {
				$strings = array_map(array($this,'splitStrings'), file('internationalization/' . $this->data["language"] .'.txt'));

                foreach ($strings as $k => $v) {
                    $this->translations[$this->data["language"]][$v[0]] = $v[1];
                }
                return $this->findString($key, $this->data["language"]);
            }
            else {
                return $key;
            }
        }
        else {
            return $this->findString($key, $this->data["language"]);
        }
	}

	//for translation purposes
    private function splitStrings($str) {
        return explode('=',trim($str));
	}
	
    private function findString($str,$lang) {
				
        if (array_key_exists($str, $this->translations[$lang])) {
            return $this->translations[$lang][$str];
        }
        return $str;
    }
}
