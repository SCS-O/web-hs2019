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
		<?php if($this->controller->isLoggedIn()) { ?> 
			<a href="index.php?action=order_overview"><?php echo $this->controller->getTranslation("menu_order_overview") ?></a>
		<?php } ?>		
		<a href="index.php?action=contact"><?php echo $this->controller->getTranslation("menu_contact") ?></a>

		<div class="languages">
			<a href="index.php?language=de-CH&action=<?php echo $action ?>">De</a>
			<a href="index.php?language=fr-CH&action=<?php echo $action ?>">Fr</a>
			<a href="index.php?language=en-US&action=<?php echo $action ?>">En</a>
		</div>
		<?php if($this->controller->isLoggedIn()) {
		 echo "<p>You are logged in! </p> <a href=\"index.php?action=logout\">Logout</a>"; 
		 }
		 else{
			 echo"
	<div class='login'>
		<form action='index.php?action=login' method='post'>
			<label>E-Mail</label>
			<input type='text' name='login'>
			<label>Password</label>
			<input type='password' name='pw'>
			<input type='submit' value='Login'>
			<a href='index.php?action=registration'>";?> <?php echo $this->controller->getTranslation('registration') ?> <?php echo "</a> 
		</form>
	 </div>";}?>
	 </nav>
	 <?php echo isset($message) ? "<h5>".$message."</h5>" : ""; ?>
	 	 	
	<main>
		<section class="inner">
			<?php include $innerTpl; ?>
		</section>
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
	</main> 
	<footer><?php echo $this->controller->getTranslation("page_footer") ?></footer>
</body>
</html>