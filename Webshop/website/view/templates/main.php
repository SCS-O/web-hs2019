<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="css/stylesheet.css" />
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>  
</head>
<body>
	<nav>
		<a href="index.php">HOME</a> 
		<a href="index.php?action=contact">Contact</a>
		<a href="index.php?language=de-CH">De</a>
		<a href="index.php?language=fr-CH">Fr</a>
		<a href="index.php?language=it-CH">It</a>
 	</nav>
 	<section class="cart-holder">
	 	 <?php $cart->render($language); ?>
  	</section>
	<?php include $innerTpl; ?>
</body>
</html>
