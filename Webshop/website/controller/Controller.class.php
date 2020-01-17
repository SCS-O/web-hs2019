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

	public function getLanguage() {
		return $this->data["language"];
	}

	public function getDebugMessage() {
		return $this->debugMessage;
	}

	public function register(request $request)
	{
		//Sanitize
		$firstName = filter_var($request->getParameter('firstName', ''), FILTER_SANITIZE_STRING);
		$lastName = filter_var($request->getParameter('lastName', ''), FILTER_SANITIZE_STRING);
		$address = filter_var($request->getParameter('address', ''), FILTER_SANITIZE_STRING);
		$city = filter_var($request->getParameter('city', ''), FILTER_SANITIZE_STRING);
		$email = filter_var($request->getParameter('email', ''), FILTER_SANITIZE_EMAIL);
		$passwordHash = filter_var($request->getParameter('passwordHash', ''), FILTER_SANITIZE_STRING);

		//Validate
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->data['message'] = "Use a valid email please";
			return $this->internalRedirect('registration',$request);
		}

		if (!filter_var($passwordHash, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/.{5,149}/")))) {
			$this->data['message'] = "Put at least 5, at max 149 characters. ";
			return $this->internalRedirect('registration',$request);
		}

		$acc = Account::getAccountByEmail($email);
		if (!is_null($acc)) {
			$this->data['message'] = "Already in use";
			return $this->internalRedirect('home',$request);
		}
		$acc = new Account();
		$acc->setFirstName($firstName);
		$acc->setLastName($lastName);
		$acc->setAddress($address);
		$acc->setCity($city);
		$acc->setEmail($email);
		$acc->setPasswordHash($passwordHash);
		$acc->saveObject();

		return $this->internalRedirect('home',$request);


	}
	public function login(request $request)
	{	
		//Sanitize
		$login = filter_var($request->getParameter('login', ''), FILTER_SANITIZE_EMAIL);
		$pw = filter_var($request->getParameter('pw', ''), FILTER_SANITIZE_STRING);
		//Validate
		if (!filter_var($login, FILTER_VALIDATE_EMAIL)){
			$this->data['message'] = "Invalid credentials";
			return  $this->internalRedirect('home',$request);
		}

		$acc = Account::getAccountByEmail($login);
		if (is_null($acc)) {
			$this->data['message'] = "Try Again 1";
			return  $this->internalRedirect('home',$request);
		}

		if (!$acc->checkCredentials($login, $pw)){
			$this->data['message'] = "Try Again 2";
			return $this->internalRedirect('home',$request);
		}

		 

		$this->startSession();
		$_SESSION['user'] = $acc->getAccountId();
		if($acc->getAccountType()==='admin'){
			$this->isAdmin = true;
			$this->data['message'] = "is admin";
		}
		return $this->internalRedirect('home',$request);
	}
	public function logout(Request $request)
	{
		$this->startSession();
		session_destroy();
		$_SESSION = array();
		return $this->internalRedirect('home',$request);
	}

	public function isLoggedIn()
	{
		$this->startSession();
		return isset($_SESSION['user']);
	}

	public function getCurrentUser()
	{
		if($this->isLoggedIn() === false)
		{
			return null;
		}
		else{
			return Account::getAccountById($_SESSION['user']);
		}
	}


	public function isAdmin() {
		if(isset($_SESSION['user'])){
			$acc = Account::getAccountById($_SESSION['user']);
			if ($acc->getAccountType() === 'admin'){
				return true;
			} 
			else{
				return false;
			}
		}
	}

	// ACTION - Public 
	public function home(Request $request) {
		$this->initializeController($request);
		$this->title = $this->getTranslation("pagetitle_home");
		
		$this->data['hasMemes'] = (count(Article::getArticles(14)) === 0) ? false : true;
		
		$this->data["articles"] = Article::getArticles(14);

	}
	public function forbidden(Request $request){
		$this->initializeController($request);
		$this->title = $this->getTranslation("pagetitle_forbidden");
	}

	public function registration(Request $request) {
		$this->initializeController($request);
		$this->title = $this->getTranslation("pagetitle_registration");
	}

	public function contact(Request $request) {
		$this->initializeController($request);
		$this->title = $this->getTranslation("pagetitle_contact");
	}

	public function clear_cart_and_go_home(Request $request){
		$this->initializeController($request);
		$this->data["cart"]->clear();

		header('Location: ' . '/index.php');		
	}

	// ACTION - Logged - In
	public function order_overview(Request $request)
	{
		$this->initializeController($request);
		$account = $this->getCurrentUser();

		
		$this->title = $this->getTranslation("pagetitle_order_overview");

		$orders = array();

		foreach($account->getOrders() as $o)
		{	
			$order = new stdClass();

			$order->order_id = $o->getOrderId();
			$order->orderState = $o->getOrderState();
			$order->articleCount = count($o->getArticles());
			$order->totalAmount = 0;
			
			foreach($o->getArticles() as $article)
			{
				$order->totalAmount += $article->getArticlePrice();
			}

			$orders[$order->order_id] = $order;
		}

		$this->data['orders'] = $orders;
	}

	public function checkout(Request $request)
	{
		$this->initializeController($request);
		//TODO Login necessary
		$account = $this->getCurrentUser();
		$this->title = $this->getTranslation("pagetitle_checkout");

		if(count($this->data["cart"]->getItems()) === 0)
		{
			return $this->internalRedirect('home', $request);
		}
		
		$totalAmount = 0;
		foreach($this->data["cart"]->getItems() as $article)
		{
			$totalAmount += $article->getArticlePrice();
		}


		$this->data["articles"] = $this->data["cart"]->getItems();	
		$this->data["total"] = $totalAmount;		
	}

	public function confirm_checkout(Request $request)
	{
		//TODO Login necessary
		$this->initializeController($request);

		$account = $this->getCurrentUser();
		
		//cart has to have at least 1 entry for checkout to be possible
		if(count($this->data["cart"]->getItems()) === 0)
		{
			return $this->internalRedirect('home', $request);
		}

		$this->data['orderId'] = Order::newOrder($this->data["cart"]->getItems(), $account)->getOrderId();

		$this->data["cart"]->clear();

		return $this->internalRedirect('order_detail', $request);
	}

	public function order_detail(Request $request)
	{
		//TODO Login necessary
		$this->initializeController($request);

		$account = $this->getCurrentUser();


		//order id in request is prioritized before data['orderid']
		if(!isset($this->data['orderId']) && !$request->isParameter('orderId'))
		{
			return $this->internalRedirect('order_overview', $request);
		}
		else if($request->isParameter('orderId'))
		{
			$this->data['orderId'] = $request->getParameter('orderId');
		}

		$order = Order::getOrderById($this->data['orderId']);

		if($order->getOrdererAccount() !== $account->getAccountId())
		{			
			throw new Exception('Account does not match order');
		}
		
		$this->data['order'] = $order;
		$this->data['articles'] = $order->getArticles();
	}

	//ACTION ADMIN
	public function admin_home(Request $request) {
		if(!$this->isAdmin){
			return $this->internalRedirect('forbidden',$request);
		}
		$this->initializeController($request);
		$this->title = $this->getTranslation("pagetitle_admin_home");
	}

	public function admin_userlist(Request $request) {
		if(!$this->isAdmin){
			return $this->internalRedirect('forbidden',$request);
		}
		$this->initializeController($request);
		$this->title = $this->getTranslation("pagetitle_admin_user_list");
		$this->data["accounts"] = Account::getAccounts();
	}

	public function admin_useredit(Request $request) {
		if(!$this->isAdmin){
			return $this->internalRedirect('forbidden',$request);
		}
		$this->initializeController($request);
		$this->title = $this->getTranslation("pagetitle_admin_user_edit");

		if(!$request->isParameter('accountid') || !Account::isAccount($request->getParameter('accountid')))
		{
			return $this->internalRedirect('admin_userlist', $request);
		}

		//TODO ADD MESSAGE SUCESS SAVE
		$this->data["account"] = Account::getAccountById($request->getParameter('accountid'));
	}

	function admin_usersave(Request $request) {
		if(!$this->isAdmin){
			return $this->internalRedirect('forbidden',$request);
		}
		$this->initializeController($request);
		$this->title = $this->getTranslation("pagetitle_admin_user_edit");

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
		if(!$this->isAdmin){
			return $this->internalRedirect('forbidden',$request);
		}
		$this->initializeController($request);
		$this->title = $this->getTranslation("pagetitle_admin_meme_overview");
		$this->title = "Admin meme overview";

		$this->data["articles"] = Article::getArticles();
	}

	public function addMemes(Request $request) {
		if(!$this->isAdmin){
			return $this->internalRedirect('forbidden',$request);
		}
		$this->initializeController($request);

		if(!$request->isParameter("subreddit")){
			throw new Exception("Bad request");
		}

		$this->importMemesFromSubreddit($request->getParameter("subreddit"), 5);
		//TODO ADD MESSAGE SUCESS SAVE

		return $this->internalRedirect('admin_meme_overview', $request);
	}

	// AJAX CALL
	public function ajax_cart(Request $request)
	{
		$this->initializeController($request);
		
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = new Cart();
		}
		$cart = $_SESSION['cart'];
	
		if ($request->isParameter("article-id")){
			$article = $request->getParameter('article-id');
			$cart->addItem($article);
		}
		
		$this->data["cart"] = $cart;
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

	private function importMemesFromSubreddit($subreddit, $count)
	{
		$json = $this->importMemesFromReddit($subreddit);
		
		$cnt = 0;
		$listMemes = array();
		foreach($json['data']['children'] as $post)
		{
			//continue, disallow duplicates
			if(Article::isArticle($post['data']['id']) === true)
			{
				continue;
			}

			//no adult content ;-)
			if($post['data']['over_18'] === true)
			{
				continue;
			}
			//only reddit pictures
			if(preg_match("/^https:\/\/i.redd.it.\w*.jpg$/", $post['data']['url']))
			{
				continue;
			}

			$meme_id = $post['data']['id'];
			$listMemes[$meme_id] = Article::create(
				//link title (article name de)
				$post['data']['title'], 
				$post['data']['permalink'], 
				$post['data']['id'], 
				//meme author (article desc fr)
				$post['data']['author'], 
				$post['data']['created'], 
				//subreddit desc (article descrption en)
				$post['data']['subreddit'], 
				$post['data']['score'], 
				$post['data']['url'], 
				$post['data']['thumbnail']
			);
			$listMemes[$meme_id]->saveObject();

			$cnt++;
			if(!($cnt < $count))
			{
				break;
			}
		}
		return $listMemes;
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
