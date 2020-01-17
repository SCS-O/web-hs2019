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
		<a href="index.php?action=admin_home"><?php echo $this->controller->getTranslation("menu_admin") ?></a>
		<a href="index.php?action=admin_userlist"><?php echo $this->controller->getTranslation("menu_admin_userlist") ?></a>
		<a href="index.php?action=admin_meme_overview"><?php echo $this->controller->getTranslation("menu_admin_meme_overview") ?></a>
		<div class="languages">
			<a href="index.php?language=de-CH&action=<?php echo $action ?>">De</a>
			<a href="index.php?language=fr-CH&action=<?php echo $action ?>">Fr</a>
			<a href="index.php?language=en-US&action=<?php echo $action ?>">En</a>
		</div>
		<?php echo "<p>You are logged in! </p> <a href=\"index.php?action=logout\">Logout</a>"; ?>
 	</nav>
	 <?php echo isset($message) ? "<h5>".$message."</h5>" : ""; ?>
	<main>
		<section class="inner">
			<?php include $innerTpl; ?>
		</section>
	</main>
	<footer><?php echo $this->controller->getTranslation("page_footer") ?></footer>
</body>
</html>
