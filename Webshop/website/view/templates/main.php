<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="css/stylesheet.css" />
	<link rel="shortcut icon" type="image/png" href="images/favicon-16x16.png"/>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>  
	<?php
		if($this->controller->getDebugMessage() !== "")
		{
			?>
			<script>
				alert("<?php echo $this->controller->getDebugMessage() ?>");
			</script>
			<?php
		}
		
	?>
</head>
<body>
	<nav>
		<a href="index.php"><?php echo $this->controller->getTranslation("menu_home") ?></a> 
		<a href="index.php?action=order_overview"><?php echo $this->controller->getTranslation("menu_order_overview") ?></a>
		<a href="index.php?action=contact"><?php echo $this->controller->getTranslation("menu_contact") ?></a>
		<a href="index.php?action=admin_home"><?php echo $this->controller->getTranslation("menu_admin") ?></a>
		<a href="index.php?language=de-CH&action=<?php echo $action ?>">De</a>
		<a href="index.php?language=fr-CH&action=<?php echo $action ?>">Fr</a>
		<a href="index.php?language=en-US&action=<?php echo $action ?>">En</a>
 	</nav>
	 <?php
		if($action != "checkout")
		{
		?>
		<section class="cart-holder">
		<?php $cart->render($this->controller); ?>
		</section>
		<?php
		}
	 ?>
	<?php include $innerTpl; ?>
</body>
</html>