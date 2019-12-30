<?php
/*
 * Adopted from topic 10 by Philipp Locher
 */
	require_once("../util/autoloader.php");

	session_start();

	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'] = new Cart();
	}
	$cart = $_SESSION['cart'];

	if (isset($_POST['article'])) {
		$article = $_POST['article'];
		$cart->addItem($article);
	}

	echo $cart->render($_SESSION['language']);
