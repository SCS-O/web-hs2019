<?php
/*
 * Adopted from topic 10 by Philipp Locher
 */
	require_once("../util/autoloader.php");


    //TODO: Auslagern
    const HOST = "localhost";
    const USER = "www";
    const PW = "1234";
    const DB_NAME = "meme_shop";
	// Inizialize model
	if (!DB::create(HOST, USER, PW, DB_NAME)) {
		die("Unable to connect to database [".DB::getInstance()->connect_error."]");
	}

	session_start();

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = new Cart();
	}
	$cart = $_SESSION['cart'];

	if (isset($_POST['article-id'])) {
		$article = $_POST['article-id'];
		$cart->addItem($article);
	}

	echo $cart->render($_SESSION['language']);
